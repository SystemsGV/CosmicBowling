<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SubCategories;
use App\Models\Admin\Products;
use App\Models\Admin\Calendar;
use App\Models\Admin\calendarIntervals;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Productos",
            'subcategories' => SubCategories::all()
        ];
        return view('admin.calendar.index', $data);
    }

    public function show()
    {
        $products = Calendar::show();
        return response()->json(['data' => $products]);
    }

    public function store(Request $request, Products $products)
    {
        try {
            $calendar = new Calendar();
            $calendar->subcategory_id = $request->input('data-id');
            $calendar->name_calendar = $request->input('eventTitle');
            $calendar->price_calendar = $request->input('eventPrice');
            $calendar->extent_calendar = $request->input('eventLabel');
            $calendar->start_calendar = $request->input('eventStartDate');
            $calendar->end_calendar = $request->input('eventEndDate');
            $calendar->save();

            $calendarId = $calendar->id_calendar;

            $availableQuantity = $products->where('subcategory_id', $request->input('data-id'))
                ->where('status_product', 1)
                ->count();

            $timeIntervals = $this->getTimeIntervals($request->input('eventStartDate'), $request->input('eventEndDate'));

            foreach ($timeIntervals as $time) {
                $quantity = $time === '23:00' ? 0 : $availableQuantity;

                calendarIntervals::create([
                    'subcategory_id' => $request->input('data-id'),
                    'calendar_id' => $calendarId,
                    'date_citem' => (new DateTime($request->input('eventStartDate')))->format('Y-m-d'),
                    'time_interval' => $time,
                    'available_quantity' => $quantity,
                    'price_citem' => $request->input('eventPrice'),
                ]);
            }

            return response()->json([
                'status' => 'success',
                'calendar_id' => $calendarId,
                'time_intervals' => $timeIntervals,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    function getTimeIntervals($start, $end, $interval = '30 minutes')
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $intervalParts = explode(' ', $interval);
        $intervalValue = $intervalParts[0];
        $intervalUnit = strtoupper(substr($intervalParts[1], 0, 1));

        $interval = new DateInterval("PT{$intervalValue}{$intervalUnit}");
        $period = new DatePeriod($start, $interval, $end);

        $times = [];
        foreach ($period as $time) {
            $times[] = $time->format('H:i');
        }
        if ($end->format('H:i') != end($times)) {
            $times[] = $end->format('H:i');
        }

        return $times;
    }
}
