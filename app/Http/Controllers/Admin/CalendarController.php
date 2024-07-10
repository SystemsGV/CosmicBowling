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

    public function store(Request $request)
    {
        try {
            $a = $request->input('eventTitle');
            $b = $request->input('eventLabel');
            $c = $request->input('eventStartDate');
            $d = $request->input('eventEndDate');
            $e = $request->input('data-id');

            $calendar = new Calendar();
            $calendar->subcategory_id = $e;
            $calendar->name_calendar = $a;
            $calendar->extent_calendar = $b;
            $calendar->start_calendar = $c;
            $calendar->end_calendar = $d;
            $calendar->save();

            $calendarId = $calendar->id_calendar;

            $availableQuantity = Products::where('subcategory_id', $e)->where('status_product', 1)->count();
            $timeIntervals = $this->getTimeIntervals($c, $d);

            foreach ($timeIntervals as $time) {
                calendarIntervals::create([
                    'subcategory_id' => $e,
                    'calendar_id' => $calendarId,
                    'date_citem' => (new DateTime($c))->format('Y-m-d'),
                    'time_interval' => $time,
                    'available_quantity' => $availableQuantity,
                    'price_citem' => 0.00,
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
