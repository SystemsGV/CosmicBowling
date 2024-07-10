<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holidays extends Model
{
    use HasFactory;

    protected $table = 'holidays';
    protected $primaryKey = 'id_holiday';
    protected $fillable = ['name_holiday', 'date_holiday', 'status_holiday'];

    public static function show()
    {
        $categories = self::all();

        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->id_holiday,
                'name' => $category->name_holiday,
                'holiday' => $category->date_holiday,
                'status' => $category->status_holiday,
            ];
        }

        return $data;
    }
}
