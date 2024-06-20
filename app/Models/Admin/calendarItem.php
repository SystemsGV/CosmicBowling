<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Static_;

class calendarItem extends Model
{
    use HasFactory;

    protected $table = 'calendar_items';
    protected $primaryKey = 'id_citem';

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategories::class, 'subcategory_id_citem');
    }

    /**
     * Filter and group calendar items by subcategory and date.
     *
     * @param int $subcategoryId
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public static function filterAndGroupByProductAndDate($subcategoryId, $date)
    {
        $result = self::where('subcategory_id_citem', $subcategoryId)
            ->where('date_citem', $date)
            ->selectRaw('product_id')
            ->selectRaw('SUM(CASE WHEN status_citem = 1 THEN 1 ELSE 0 END) as active_items')
            ->groupBy('product_id')
            ->orderBy('active_items', 'desc')
            ->orderBy('product_id', 'asc')
            ->first(); // Obtener solo el primer resultado

        return $result ? $result->product_id : null;
    }

    public static function groupProductCalendar($product, $date)
    {
        return self::where('product_id', $product)
            ->where('date_citem', $date)
            ->get()
            ->map(function ($row) {
                return [
                    "id" => $row->id_citem,
                    "hour" => $row->hour_citem,
                    "dateItem" => $row->date_citem,
                    "price" => $row->price_citem,
                    "status" => $row->status_citem
                ];
            })
            ->toArray();
    }
}
