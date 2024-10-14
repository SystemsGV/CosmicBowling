<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Booking;
use Carbon\Carbon;
use DateTime;
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
    $booking = Booking::where('reservation_code', $code)
      ->orWhere('order_id', $code)
      ->first();


    if ($booking) {
      $booking->status = "used";
      $booking->save();

      return response()->json(['icon' => 'success', 'message' => 'Reserva validada exitosamente.']);
    } else {
      return response()->json(['icon' => 'error', 'message' => 'No se encontro la reserva.']);
    }
  }
}
