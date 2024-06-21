<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\calendarIntervals;
use App\Models\Admin\SubCategories;
use App\Models\Admin\Products;
use App\Models\Admin\calendarItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

            // Get enabled items grouped by product and date for the selected subcategory
            $hours = calendarIntervals::filterBySubcategoryAndDate($subcategory->id_subcategory, $tomorrow);

            // return response()->json($hours);

            // Return the view with the subcategory, associated products, enabled product, and hours data
            return view('frontend.cart.cart', compact('subcategory', 'hours'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
