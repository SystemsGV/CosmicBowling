<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    protected $fillable = ['name_category', 'descr_category', 'img_category', 'status_category'];

    public function subcategories()
    {
        return $this->hasMany(SubCategories::class, 'category_id', 'id_category');
    }

    public static function getAllCategories()
    {
        $categories = self::all();

        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->id_category,
                'name' => $category->name_category,
                'description' => $category->descr_category,
                'image' => $category->img_category,
                'status' => $category->status_category,
            ];
        }

        return $data;
    }
    public static function getSelectCategories()
    {
        return Categories::all();
    }

    public static function selectCategories()
    {
        $categories = self::where('status_category', 1)->get();

        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->id_category,
                'name' => $category->name_category,
            ];
        }

        return $data;
    }
}
