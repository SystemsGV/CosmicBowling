<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Jobs\SendPaymentSummaryMail;
use App\Models\Admin\Cart;
use App\Services\VisaNetService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Booking extends Controller
{
    protected $visanetService;

    public function __construct(VisaNetService $visanetService)
    {
        $this->visanetService = $visanetService;
    }

    public function summaryPayment(Request $request)
    {
        $title = 'Detalles de Reserva';
        $summary = session('summary');
        $cart = session('cart');
        $billing = session('billing');
        $purchaseNumber = $summary['purchaseNumber'];
        $quantity = $summary['quantity'];
        $amount = $summary['amount'];
        $hours = $cart['hours'];
        $guests = $cart['guests'];
        $product = $cart['product'];

        $transaction = $request->input('transactionToken');
        $token =  $this->visanetService->generateToken();

        $data = $this->visanetService->generateAuthorization($amount, $purchaseNumber, $transaction, $token);

        $this->storeTransactionData($data);

        // Acceder a los datos del array
        $names = $billing['lastname_pat'] . ' ' . $billing['lastname_mat'] . ' ' . $billing['names'];
        // Verifica si hay un error en los datos
        if (isset($data['errorCode'])) {
            $actionCode = isset($data['data']['ACTION_CODE']) ? $data['data']['ACTION_CODE'] : null;
            $errorMessage = PaymentHelper::getErrorMessage($actionCode);
            return view('frontend.cart.err', compact('actionCode', 'errorMessage', 'names', 'purchaseNumber'));
        }

        $card = $data['dataMap']['CARD'] . " (" . $data['dataMap']['BRAND'] . ")";

        $subcategoryNamesSingular = [
            1 => 'Pista General',
            2 => 'Pista VIP',
            3 => 'Pista Duo VIP',
            4 => 'Mesa de Billar',
        ];

        $subcategoryNamesPlural = [
            1 => 'Pistas Generales',
            2 => 'Pistas VIP',
            3 => 'Pistas Duo VIP',
            4 => 'Mesas de Billar',
        ];

        $subcategoryName = $summary['quantity'] > 1
            ? ($subcategoryNamesPlural[$product] ?? 'Subcategoría desconocida')
            : ($subcategoryNamesSingular[$product] ?? 'Subcategoría desconocida');
        $hours = $cart['hours'];
        $description = "{$summary['quantity']} {$subcategoryName} x {$hours} " . ($hours > 1 ? 'horas' : 'hora');

        $this->saveCart($description);

        $datetime = $cart['date'] . ' ' . $cart['time'];
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $datetime);
        $formattedDateTime = $date->format('d/m/Y h:i A');

        $emailDetails = [
            'email' => $billing['email'],
            'purchaseNumber' => $purchaseNumber,
            'description' => $description,
            'formattedDateTime' => $formattedDateTime,
            'amount' => $amount,
            'names' => $names,
            'hours' => $hours,
            'guests' => $guests,
        ];

        SendPaymentSummaryMail::dispatch($emailDetails);

        return view('frontend.cart.details', compact('purchaseNumber', 'description', 'formattedDateTime', 'card', 'amount', 'names', 'hours', 'guests', 'title'));

    }

    private function saveCart($description)
    {
        $cart = session('cart');
        $billing = session('billing'); // Asegúrate de que la información de facturación esté disponible en la sesión
        $summary = session('summary');

        $newCart = new Cart();
        $newCart->order_id = $summary['purchaseNumber'];
        $newCart->client_id = $billing['id_client'];
        $newCart->subcategory_id = $cart['product'];
        $newCart->coupon_id = isset($cart['coupon']) ? $cart['coupon'] : null;
        $newCart->reservation_code = $summary['code'];
        $newCart->description = $description;
        $newCart->date_reserved = $cart['date'];
        $newCart->hour_init = $cart['time'];
        $newCart->quantity_lane = $summary['quantity'];
        $newCart->quantity_hours = $cart['hours'];
        $newCart->quantity_guests = $cart['guests'];
        $newCart->payment_type = '2'; // Ajusta según el tipo de pago
        $newCart->amount_discount = $summary['discount'];
        $newCart->amount = $summary['amount'];
        $newCart->document_type = $billing['type'] == 'Boleta' ? 'B' : 'F';
        $newCart->rsocial = $billing['type'] == 'Factura' ? $billing['rsocial'] : null;
        $newCart->ruc = $billing['type'] == 'Factura' ? $billing['ruc'] : null;
        $newCart->dir = $billing['type'] == 'Factura' ? $billing['dir'] : null;
        $newCart->status = 'paid';
        $newCart->save();
    }

    /**
     * Almacena los datos de la transacción en un archivo JSON.
     *
     * @param array $data Datos de la transacción a guardar.
     */
    private function storeTransactionData(array $data)
    {
        // Define la ruta del archivo
        $filePath = storage_path('app/public/transaction_data.json');

        // Lee el contenido actual del archivo (si existe)
        if (file_exists($filePath)) {
            $existingData = json_decode(file_get_contents($filePath), true);
        } else {
            $existingData = [];
        }

        // Agrega los nuevos datos al array existente
        $existingData[] = $data;

        // Guarda el array actualizado en el archivo
        file_put_contents($filePath, json_encode($existingData, JSON_PRETTY_PRINT));
    }


    public function email()
    {
        return view('frontend.emails.payment');
    }
}
