<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;

    protected $table = 'coupons';
    protected $primaryKey = 'id_coupon';
    protected $fillable = ['type_coupon', 'discount_type', 'code', 'description', 'discount_amount',  'usage_limit', 'used_count', 'valid_from', 'valid_until', 'is_active'];

    public function subcategories()
    {
        return $this->belongsToMany(subcategories::class, 'subcategory_coupon', 'coupon_id', 'subcategory_id')
            ->withTimestamps();
    }

    public static function show()
    {
        $rows = self::all();

        $data = [];

        foreach ($rows as $row) {

            $subcategories = $row->subcategories->pluck('name_subcategory');
            $subcategory_ids = $row->subcategories->pluck('id_subcategory');
            $data[] = [
                'code' => $row->code,
                'description' => $row->description,
                'd_amount' => $row->discount_amount,
                'd_type' => $row->discount_type,
                'u_limit' => $row->usage_limit,
                'u_count' => $row->used_count,
                'init' => $row->valid_from,
                'finish' => $row->valid_until,
                'status' => $row->is_active,
                'subcategories_ids' => $subcategory_ids,
                'subcategories_names' => $subcategories
            ];
        }

        return $data;
    }

    public function attachSubcategories($coupon, $subcategories)
    {
        $coupon->subcategories()->attach($subcategories);
    }
}
