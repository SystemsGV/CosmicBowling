<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;

    protected $table = 'coupons';
    protected $primaryKey = 'id_coupon';
    protected $fillable = ['code', 'description', 'discount_amount', 'discount_type', 'usage_limit', 'used_count', 'valid_from', 'valid_until', 'is_active'];

    public function subcategories()
    {
        return $this->belongsToMany(SubCategories::class, 'category_coupon', 'coupon_id', 'category_id');
    }

    public static function show()
    {
        $rows = self::all();

        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                'id' => $row->id_cupon,
                'description' => $row->description,
                'd_amount' => $row->discount_amount,
                'd_type' => $row->discount_type,
                'u_limit' => $row->usage_limit,
                'u_count' => $row->usage_count,
                'init' => $row->valid_from,
                'finish' => $row->valid_until,
                'status' => $row->is_active
            ];
        }
    }
}
