<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Holidays;
use Illuminate\Http\Request;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'title' => "Feriados",
        ];
        return view('admin.holidays.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $a = $request->input('nameH');
            $b = $request->input('dateH');

            $holiday = new Holidays();
            $holiday->name_holiday = $a;
            $holiday->date_holiday = $b;
            $holiday->save();

            return response()->json(['success' => true, 'icon' => 'success', 'message' => 'Feriado Agregado Exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'icon' => 'error', 'message' => 'Error al crear el cupón: ' . $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');

            $holiday = Holidays::findOrFail($id);
            $holiday->status_holiday = $status;
            $holiday->save();

            return response()->json(['success' => true, 'icon' => 'success', 'message' => 'Estado del feriado actualizado']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo actualizar el feriado.'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $holidays = Holidays::show();
        return response()->json(['data' => $holidays]);
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
    public function update(Request $request)
    {
        try {
            $holiday = Holidays::findOrFail($request->input('idH'));

            $a = $request->input('nameH');
            $b = $request->input('dateH');

            $holiday->name_holiday = $a;
            $holiday->date_holiday = $b;
            $holiday->save();

            return response()->json(['success' => true, 'icon' => 'success', 'message' => 'Feriado Editado Exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'icon' => 'error', 'message' => 'Error al editar el cupón: ' . $e->getMessage()]);
        }
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
