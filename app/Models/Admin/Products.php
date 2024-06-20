<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $fillable = ['category_id', 'subcategory_id', 'name_product', 'descr_product', 'img_product', 'price_productlj', 'price_productfds', 'stock_product', 'status_product', 'guests_product'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategories::class, 'subcategory_id');
    }

    public static function getAllProducts()
    {
        $products = self::all();

        $data = [];
        foreach ($products as $row) {
            $data[] = [
                'id' => $row->id_product,
                'name' => $row->name_product,
                'description' => $row->descr_product,
                'image' => $row->img_product,
                'pricelj' => $row->price_productlj,
                'pricefds' => $row->price_productfds,
                'stock' => $row->stock_product,
                'guest' => $row->guests_product,
                'status' => $row->status_product,
                'category' => optional($row->category)->name_category,
                'category_id' => optional($row->category)->id_category,
                'subcategory' => optional($row->subcategory)->name_subcategory,
                'subcategory_id' => optional($row->subcategory)->id_subcategory,
                'date_created' => $row->created_at
            ];
        }

        return $data;
    }

    public static function selectProduct($id)
    {
        return self::where('status_product', 1)
            ->where('subcategory_id', $id)
            ->get(['id_product as id', 'name_product as name', 'icon_product as icon'])
            ->toArray();
    }
}
