<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\calendarIntervals;
use App\Models\Admin\SubCategories;
use App\Models\Admin\Order;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\VisaNetService;
use Illuminate\Support\Str;

class Cart extends Controller
{
    const SHOES_PRICE = 8.00;

    protected $visanetService;

    public function __construct(VisaNetService $visanetService)
    {
        $this->visanetService = $visanetService;
    }

    public function index($formattedName)
    {
        session()->forget('billing');
        session()->forget('cart');
        session()->forget('summary');

        try {
            $tomorrow = Carbon::tomorrow()->toDateString();

            // Convert the formatted name back to its original format for searching
            $formattedName = str_replace('_', ' ', ucwords(strtolower($formattedName)));

            // Find the subcategory corresponding to the provided formatted name
            $subcategory = SubCategories::where('name_subcategory', $formattedName)->firstOrFail();
            session(['limit' => $subcategory->limit_subcategory]);
            session(['subcategory' => $subcategory->id_subcategory]);

            // Get enabled items grouped by product and date for the selected subcategory
            $hours = calendarIntervals::filterBySubcategoryAndDate($subcategory->id_subcategory, $tomorrow);

            // return response()->json($hours);

            // Return the view with the subcategory, associated products, enabled product, and hours data
            return view('frontend.cart.cart', compact('subcategory', 'hours'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function guests(Request $request)
    {
        $date = $request->input('date'); // Fecha proporcionada en la solicitud
        $hours = [
            $request->input('one'),   // Primera hora
            $request->input('two'),   // Segunda hora
            $request->input('three'), // Tercera hora
            $request->input('four')   // Cuarta hora
        ];

        // Obtener el límite de la sesión
        $limit = session('limit');

        // Consultar todos los intervalos de tiempo a la vez
        $intervals = CalendarIntervals::where('date_citem', $date)
            ->where('subcategory_id', session('subcategory'))
            ->whereIn('time_interval', array_filter($hours)) // Filtrar nulls
            ->get();

        // Filtrar los intervalos nulos
        $intervals = $intervals->filter();

        // Encontrar el intervalo con la menor cantidad disponible
        $minAvailable = $intervals->min('available_quantity');

        // Calcular el resultado
        $result = $minAvailable * $limit;


        return response()->json([
            'min_available' => $minAvailable,
            'limit' =>    $limit,
            'calculated' => $result,
        ]);
    }

    public function show($subcategory, $date)
    {
        $hours = calendarIntervals::filterBySubcategoryAndDate($subcategory, $date);
        return response()->json($hours);
    }

    public function cartData(Request $request)
    {
        $sessionData = $request->json('sessionArray', []);

        $formattedData = [];
        foreach ($sessionData as $item) {
            if (isset($item['key']) && isset($item['value'])) {
                $formattedData[$item['key']] = $item['value'];
            }
        }
        session(['cart' => $formattedData]);

        return response()->json(['success' => true, 'message' => 'Datos guardados en la sesión']);
    }

    public function billingData(Request $request)
    {
        $sessionData = $request->json()->all();
        session()->forget('billing');
        $client = Auth::guard('client')->user();

        if (isset($sessionData['type']) && $sessionData['type'] === 'Boleta') {

            // Obtener la descripción del documento
            $sunatDescription = $client->sunatTypedoc ? $client->sunatTypedoc->description_doc : null;

            // Preparar los datos del cliente
            $clientData = [
                'id_client' => $client->id_client,
                'document_id' => $client->document_id,
                'number_doc' => $client->number_doc,
                'lastname_pat' => $client->lastname_pat,
                'lastname_mat' => $client->lastname_mat,
                'names' => $client->names_client,
                'email' => $client->email_client,
                'phone' => $client->phone_client,
                'address' => $client->address_client,
                'document' => $sunatDescription,  // Agregar la descripción del documento
            ];

            // Combinar los datos de la sesión con los datos del cliente
            $combinedData = array_merge($sessionData, $clientData);

            // Guardar los datos combinados en la sesión
            session(['billing' => $combinedData]);
        } else {
            $clientData = [
                'id_client' => $client->id_client,
                'lastname_pat' => $client->lastname_pat,
                'lastname_mat' => $client->lastname_mat,
                'names' => $client->names_client,
                'email' => $client->email_client,
                'phone' => $client->phone_client,
            ];

            $combinedData = array_merge($sessionData, $clientData);

            session(['billing' => $combinedData]);
        }

        $billingData = session('billing');
        $cartData = session('cart');

        return response()->json([
            'billing' => $billingData,
            'cart' => $cartData,
        ]);
    }

    public function paymentData($couponCode = null)
    {
        $cart = session('cart');
        $totalGuests = $cart['guests'];
        $couponCode = isset($cart['coupon']) ? $cart['coupon'] : null;
        $discount = 0;
        $coupon = null;

        // Generar un código de reserva único
        $reservationCode = strtoupper(Str::random(9));

        // Obtén otros datos como el precio y la subcategoría
        $calendar = calendarIntervals::filterPayment($cart['product'], $cart['date'], $cart['time']);
        $subcategory = SubCategories::filterSubcategory($cart['product']);
        $limitPerTrack = $subcategory['limit'];

        $numberOfTracksNeeded = ceil($totalGuests / $limitPerTrack);

        // Calcular los intervalos de 30 minutos
        $halfHourIntervals = $this->getHalfHourIntervals($cart['time'], $cart['hours']);

        // Verificar disponibilidad de todos los intervalos
        $isAvailable = $this->checkAvailability($halfHourIntervals, $cart['product'], $cart['date'], $numberOfTracksNeeded);

        if (!$isAvailable) {
            return response()->json(['status' => false, 'message' => 'Ya no se encuentra disponible su horario. Por favor Verificar nuevamente.']);
        }

        $amount = $numberOfTracksNeeded * $calendar['price'];

        if ($couponCode) {
            // Traer los datos del cupón desde la base de datos
            $coupon = DB::table('coupons')
                ->where('code', $couponCode)
                ->where('is_active', 1)
                ->first();

            if ($coupon) {
                // Calcular el descuento si el cupón es válido
                if ($coupon->discount_type === 'percentage') {
                    $discount = ($amount * $coupon->discount_amount) / 100;
                } elseif ($coupon->discount_type === 'fixed') {
                    $discount = $coupon->discount_amount;
                }

                // Aplicar el descuento al precio de la pista
                $amount -= $discount;
            }
        }

        // Agregar el costo de los zapatos después de aplicar el descuento
        $amount += $totalGuests * self::SHOES_PRICE;

        // Guardar los detalles del pedido en la base de datos
        $order = new Order();
        $order->client_id = session('billing.id_client');
        $order->subcategory_id = $cart['product'];
        $order->coupon_id = $coupon ? $coupon->id : null;
        $order->reservation_code = $reservationCode;
        $order->document_type = session('billing.type') === 'Factura' ? 'F' : 'B';

        if ($order->document_type === 'F') {
            $order->rsocial = session('billing.rsocial');
            $order->ruc = session('billing.ruc');
            $order->dir = session('billing.dir');
        }

        $order->date_reserved = $cart['date'];
        $order->hour_init = $cart['time'];
        $order->quantity_lane = $numberOfTracksNeeded;
        $order->quantity_hours = $cart['hours'];
        $order->quantity_guests = $cart['guests'];
        $order->amount_discount = $discount;
        $order->amount = $amount;
        $order->status = 'pending';
        $order->payment_type = '2'; // Siempre será 2

        $order->save();

        $arrSummary = [
            'amount' => $amount,
            'description' => $subcategory['name'],
            'quantity' => $numberOfTracksNeeded,
            'purchaseNumber' => $order->id_order,
            'discount' => $discount,
            'code' => $reservationCode
        ];

        session(['summary' => $arrSummary]);

        $data = $this->showFormPayment($amount, $order->id_order);

        $sessionKey = $data['sessionKey'];

        return response()->json([
            'sessionKey' => $sessionKey,
            'amount' => $amount,
            'purchaseNumber' => $order->id_order, // Retorna el código de reserva como número de compra
            'merchantId' => config('visanet.merchant_id'),
            'logoUrl' => 'https://cosmicbowling.com.pe/new/images/logo.png',
            'timeoutUrl' => url('/'),
            'action' => url('/Reserva'),
            'jsUrl' => config('visanet.url_js'),
            'status' => true
        ]);
    }

    public function getHalfHourIntervals($startTime, $hoursToAdd)
    {
        // Convertir la hora de inicio a un objeto DateTime
        $startDateTime = new DateTime($startTime);

        // Calcular la hora de finalización
        $endDateTime = clone $startDateTime;
        $endDateTime->modify("+{$hoursToAdd} hours");

        // Inicializar el array de intervalos
        $intervals = [];

        // Generar los intervalos de 30 minutos
        while ($startDateTime < $endDateTime) {
            $intervals[] = $startDateTime->format('H:i:s');
            $startDateTime->modify('+30 minutes');
        }

        return $intervals;
    }

    public function checkAvailability($intervals, $subcategory, $date, $requiredHours)
    {
        $availability = [];

        // Consultar la base de datos para obtener la disponibilidad de cada intervalo específico
        foreach ($intervals as $interval) {
            $availability[$interval] = DB::table('calendar_intervals')
                ->where('subcategory_id', $subcategory)
                ->whereDate('date_citem', $date)
                ->where('time_interval', $interval)
                ->value('available_quantity');
        }

        // Verificar si todos los intervalos están disponibles
        foreach ($intervals as $interval) {
            // Comprobar si la cantidad disponible es menor que las horas requeridas
            if (!isset($availability[$interval]) || $availability[$interval] < $requiredHours) {
                return false; // Al menos un intervalo no tiene suficiente cantidad disponible
            }
        }

        return true; // Todos los intervalos tienen suficiente cantidad disponible
    }

    public function showFormPayment($amount, $purchaseNumber)
    {
        $token =  $this->visanetService->generateToken();
        $sessionKey = $this->visanetService->generateSession($amount, $token);
        return [
            'token' => $token,
            'sessionKey' => $sessionKey,
        ];
    }

    public function showSession()
    {
        $client = session('billing');
        $cart = session('cart');

        return response()->json(session()->all());
    }





    public function destroy($id)
    {
        //
    }
}
