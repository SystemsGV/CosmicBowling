<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupons;
use Illuminate\Http\Request;

class Coupon extends Controller
{
    public function show($code)
    {
        $coupon = Coupons::with('subcategories')->where('code', $code)->first();

        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found'], 404);
        }

        $couponData = [
            'id_coupon' => $coupon->id_coupon,
            'code' => $coupon->code,
            'discount_type' => $coupon->discount_type,
            'discount_amount' => $coupon->discount_amount,
            'usage_limit' => $coupon->usage_limit,
            'used_count' => $coupon->used_count,
            'valid_from' => $coupon->valid_from,
            'valid_until' => $coupon->valid_until,
            'is_active' => $coupon->is_active,
            'subcategory_ids' => $coupon->subcategories->pluck('id_subcategory')
        ];

        return response()->json($couponData, 200); // Enviar estado 200 si el cupón se encuentra
    }
}
