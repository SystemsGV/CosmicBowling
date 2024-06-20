<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Categories;
use App\Models\Admin\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => "Productos",
            'categories' => Categories::selectCategories()
        ];
        return view('admin.product.index', $data);
    }


    public function store(Request $request)
    {
        try {

            $uniqueFileName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();

                $file->storeAs('public/product', $uniqueFileName);
            }

            $name = $request->input('product');
            $description = $request->input('description');
            $category = $request->input('category');
            $subcategory = $request->input('subcategory');
            $pricelj = $request->input('pricelj');
            $pricefds = $request->input('pricefds');

            $stock = $request->input('stock');
            $limit = $request->input('limit');
            $status = 1;

            $product = new Products();
            $product->category_id = $category;
            $product->subcategory_id = $subcategory;
            $product->name_product = "$name";
            $product->descr_product = $description;
            $product->img_product = $uniqueFileName;
            $product->price_productlj = $pricelj;
            $product->price_productfds = $pricefds;
            $product->stock_product = $stock;
            $product->guests_product = $limit;
            $product->status_product = $status;

            $product->save();

            return response()->json([
                'icon' => 'success',
                'message' => 'Producto Agregado'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'message' => 'Error: Reportar con Sistemas',
                'error' => 'Error en el servidor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $products = Products::getAllProducts();
        return response()->json(['data' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $id = $request->input('product_id');
            $name = $request->input('product');
            $description = $request->input('description');
            $category = $request->input('category');
            $subcategory = $request->input('subcategory');
            $price = $request->input('pricelj');
            $pricefds = $request->input('pricefds');
            $stock = $request->input('stock');
            $limit = $request->input('limit');

            $product =  Products::findOrFail($id);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();

                $file->storeAs('public/product', $uniqueFileName);

                $product->img_product = $uniqueFileName;
            }

            $product->category_id = $category;
            $product->subcategory_id = $subcategory;
            $product->name_product = "$name";
            $product->descr_product = $description;
            $product->price_productlj = $price;
            $product->price_productfds = $pricefds;
            $product->stock_product = $stock;
            $product->guests_product = $limit;

            $product->save();

            return response()->json([
                'icon' => 'success',
                'message' => 'Producto Modificado'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'message' => 'Error: Reportar con Sistemas',
                'error' => 'Error en el servidor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function selectProduct(Request $request)
    {
        $categoryId = $request->input('id');

        $subcategories = Products::selectProduct($categoryId);

        return response()->json($subcategories);
    }
}
