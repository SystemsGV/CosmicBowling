<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\calendarIntervals;
use App\Models\Admin\SubCategories;
use App\Models\Admin\Products;
use App\Models\Admin\calendarItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;

class Cart extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $formattedName
     * @return \Illuminate\Http\Response
     */

    public function index($formattedName)
    {
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
            'calculated' => $result,
            'intervals' => $intervals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($subcategory, $date)
    {
        $hours = calendarIntervals::filterBySubcategoryAndDate($subcategory, $date);
        return response()->json($hours);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
