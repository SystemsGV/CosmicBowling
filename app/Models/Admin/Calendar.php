<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'calendar';
    protected $primaryKey = 'id_calendar';
    protected $fillable = ['subcategory_id ', 'name_calendar', 'extent_calendar', 'start_calendar', 'end_calendar'];

    public static function show()
    {
        $items = self::all();

        $data = [];
        foreach ($items as $row) {
            $data[] = [
                'id' => $row->id_calendar,
                'title' => $row->name_calendar,
                'price' => $row->price_calendar,
                'start' => $row->start_calendar,
                'end' => $row->end_calendar,
                'calendar' => $row->extent_calendar,
            ];
        }

        return $data;
    }
}
