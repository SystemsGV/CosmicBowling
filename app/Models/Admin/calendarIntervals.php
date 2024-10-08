<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendarIntervals extends Model
{
    use HasFactory;

    protected $table = 'calendar_intervals';
    protected $primaryKey = 'id_citem';
    public $timestamps = false;

    protected $fillable = [
        'subcategory_id',
        'calendar_id',
        'date_citem',
        'time_interval',
        'available_quantity',
        'price_citem',
    ];


    public static function filterBySubcategoryAndDate($subcategoryId, $date)
    {
        $data = self::where('subcategory_id', $subcategoryId)
            ->whereDate('date_citem', $date)
            ->get();
        $result = [];
        foreach ($data as $row) {
            $result[] = [
                'id' => $row->id_citem,
                'subcategory' => $row->subcategory_id,
                'date' => $row->date_citem,
                'hour' => $row->time_interval,  // Corregido: Debería ser el intervalo de tiempo
                'available' => $row->available_quantity,
                'price' => $row->price_citem,
            ];
        }

        return $result;
    }


    public static function filterPayment($subcategory, $date, $time)
    {
        // Buscar un solo registro que coincida con los criterios
        $data = self::where('subcategory_id', $subcategory)
            ->whereDate('date_citem', $date)
            ->where('time_interval', $time)
            ->first();

        // Si se encuentra un registro, devolver el resultado
        if ($data) {
            return [
                'price' => $data->price_citem,
            ];
        }

        // Si no se encuentra ningún registro, retornar null o un valor por defecto
        return null;
    }
}
