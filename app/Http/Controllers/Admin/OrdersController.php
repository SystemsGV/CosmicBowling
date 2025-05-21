<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Booking;
use Carbon\Carbon;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $title = "Reservas";

        return view('admin.orders.index', compact('title'));
    }

    public function show(Request $request)
    {
        if ($request->filled('start_date') && $request->filled('end_date') && $request->input('isChecked') == '0') {

            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
            $column = "shop";
        } else if ($request->filled('start_date') && $request->filled('end_date') && $request->input('isChecked') == '1') {

            $startDateFormatted  = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDateFormatted  = Carbon::parse($request->input('end_date'))->endOfDay();

            $startDate  = $startDateFormatted->toDateString();
            $endDate  = $endDateFormatted->toDateString();
            $column = "entrance";
        } else {
            // Fecha de hoy
            $endDate = new DateTime();
            $endDate->setTime(23, 59, 59);
            $endDateString = $endDate->format('Y-m-d H:i:s');

            // Fecha de hace un mes
            $startDate = new DateTime();
            $startDate->modify('-1 month');
            $startDate->setTime(0, 0, 0);
            $startDateString = $startDate->format('Y-m-d H:i:s');

            $startDate = $startDateString;
            $endDate = $endDateString;
            $column = "shop";
        }

        $data = Booking::getAllBooking($startDate, $endDate, $column);
        return response()->json(['data' => $data]);
    }

    public function showReservation()
    {
        return view('admin.orders.validate');
    }

    public function search($code)
    {
        $data = Booking::getBooking($code);
        return response()->json($data);
    }

    public function validateReservation($code)
    {
        // Si el código tiene exactamente 7 caracteres, buscar solo por reservation_code
        if (strlen($code) === 7) {
            $booking = Booking::where('reservation_code', $code)->first();
        } else {
            // Buscar por cart o order_id
            $booking = Booking::where('id_cart', $code);
        }

        if ($booking) {


            $booking->status = "used";
            $booking->save();

            $html = '<!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>PDF</title>
          <style>
          @page { margin-left: 23px; }
          * { font-family: "century gothic"; }
          table { margin: 1px; font-size:12px; border-collapse: collapse; width: 100%; }
          thead tr td { background-color: #00BCD4; text-align: center; padding: 3px; color: white; }
          thead { border-bottom: 1px solid #000; border-style: dotted; }
          tbody tr td { padding: 1em; text-align: center; }
          .combo-cell { text-align: center; }
          </style>
      </head>
      <body>
          <h4>Validación de Reserva Web</h4>
          <p>Fecha: ' . date('Y-m-d H:i:s') . '</p>
          <table border="1">
              <thead>
                  <tr>
                      <th>Cod. y Nº Reserva</th>
                      <th>Producto</th>
                      <th>Precio</th>
                  </tr>
              </thead>
              <tbody>';

            $html .= '<tr>
              <td class="combo-cell">' . $booking->reservation_code . '<br>Nº ' . $booking->order_id . '</td>
              <td>' . $booking->description . '<br>' . $booking->quantity_guests . ' Integrantes</td>
              <td>S/. ' . $booking->amount . '</td>
            </tr>';

            $html .= '</tbody></table></body></html>';

            $options = new \Dompdf\Options();
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($options);

            $dompdf->loadHtml($html);
            $dompdf->setPaper([0, 0, 200, 426]);

            $dompdf->render();

            $pdfContent = $dompdf->output();

            $url = public_path('vouchers/' . $booking->order_id . '.pdf');
            $path = asset('vouchers/' . $booking->order_id . '.pdf');

            file_put_contents($url, $pdfContent);

            return response()->json(['icon' => 'success', 'message' => 'Reserva validada exitosamente.', 'pdfUrl' => $path]);
        } else {
            return response()->json(['icon' => 'error', 'message' => 'No se encontró la reserva.']);
        }
    }


    public function attachInvoice(Request $request)
    {
        $booking = Booking::where('id_cart', $request->input('id'))->first();

        if ($booking) {
            $booking->invoice = $request->input('invoiceText');
            $booking->save();

            return response()->json(['icon' => 'success', 'message' => 'Factura/Boleta adjuntada correctamente.']);
        } else {
            return response()->json(['icon' => 'error', 'message' => 'No se encontró la reserva.']);
        }
    }
}
