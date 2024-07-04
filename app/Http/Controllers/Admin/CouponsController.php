<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Categories;
use App\Models\Admin\Coupons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponsController extends Controller
{
    public function index()
    {
        $data['title'] = "Cupones";
        $data['categories'] = Categories::with('subcategories')->get();
        return view('admin.coupon.index', $data);
    }

    public function show()
    {
        $coupons = Coupons::show();
        return response()->json(['data' => $coupons]);
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $coupon = new Coupons();
            $coupon->code = $request->input('code');
            $coupon->description = $request->input('description');
            $coupon->type_coupon = $request->input('typeD');
            $coupon->usage_limit = $request->input('quantity');
            $coupon->discount_type = $request->input('typeC');
            $coupon->discount_amount = $request->input('discount');
            $coupon->valid_from = $request->input('startDate');
            $coupon->valid_until = $request->input('endDate');

            $coupon->save();
            $coupon->subcategories()->attach($request->input('subcategories'));

            DB::commit();

            return response()->json(['success' => true, 'icon' => 'success', 'message' => 'Cupón creado exitosamente']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'icon' => 'error', 'message' => 'Error al crear el cupón: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $coupon = Coupons::where('code', $request->input('code'))->first();

            if (!$coupon) {
                return response()->json(['success' => false, 'icon' => 'error', 'message' => 'Cupón no encontrado']);
            }

            $coupon->description = $request->input('description');
            $coupon->type_coupon = $request->input('typeD');
            $coupon->usage_limit = $request->input('quantity');
            $coupon->discount_type = $request->input('typeC');
            $coupon->discount_amount = $request->input('discount');
            $coupon->valid_from = $request->input('startDate');
            $coupon->valid_until = $request->input('endDate');

            $coupon->save();
            $coupon->subcategories()->sync($request->input('subcategories'));

            DB::commit();

            return response()->json(['success' => true, 'icon' => 'success', 'message' => 'Cupón editado exitosamente']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'icon' => 'error', 'message' => 'Error al editar el cupón: ' . $e->getMessage()]);
        }
    }


    public function codeCoupon()
    {
        $code = $this->generateUniqueCouponCode();

        return response()->json(['code' => $code]);
    }

    private function generateUniqueCouponCode($length = 12)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);

        do {
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        } while (Coupons::where('code', $randomString)->exists());

        return $randomString;
    }
}
