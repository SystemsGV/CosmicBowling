<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SubCategories extends Model
{
    use HasFactory;

    protected $table = 'subcategories';
    protected $primaryKey = 'id_subcategory';
    protected $fillable = ['name_subcategory', 'descr_subcategory', 'time_init', 'time_finish', 'img_subcategory', 'status_subcategory', 'category_id'];


    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'subcategory_id');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupons::class, 'subcategory_coupon', 'subcategory_id', 'coupon_id')
            ->withTimestamps();
    }

    public static function getAllSubcategories()
    {
        $subcategories = self::all();

        $data = [];
        foreach ($subcategories as $subcategory) {
            $data[] = [
                'id' => $subcategory->id_subcategory,
                'name' => $subcategory->name_subcategory,
                'description' => $subcategory->descr_subcategory,
                'tinit' => $subcategory->time_init,
                'tfinish' => $subcategory->time_finish,
                'image' => $subcategory->img_subcategory,
                'status' => $subcategory->status_subcategory,
                'category' => optional($subcategory->category)->name_category,
                'category_id' => optional($subcategory->category)->id_category,
            ];
        }

        return $data;
    }

    public static function sltcsubCategories($categoryId)
    {
        return self::where('status_subcategory', 1)
            ->where('category_id', $categoryId)
            ->get(['id_subcategory as id', 'name_subcategory as name'])
            ->toArray();
    }

    public static function filterSubcategory($subcategory)
    {
        $data = self::find($subcategory);

        if ($data) {
            return [
                'name' => $data->name_subcategory,
                'limit' => $data->limit_subcategory,
                'status' => $data->status_subcategory
            ];
        }

        return null;
    }

    public function getFormattedNameAttribute()
    {
        return str_replace(' ', '_', ucwords(strtolower($this->name_subcategory)));
    }

    public function getImageUrlAttribute()
    {
        return Storage::url('subcategory/' . $this->img_subcategory);
    }
}
