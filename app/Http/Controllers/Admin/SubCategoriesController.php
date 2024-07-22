<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SubCategories;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    public function index()
    {
        $data['title'] = "SubCategorias";
        return view('admin.subcategory.index', $data);
    }

    public function show()
    {
        $categoriesData = SubCategories::getAllSubcategories();
        return response()->json(['data' => $categoriesData]);
    }
    public function new(Request $request)
    {
        try {

            // Inicialización de variables
            $uniqueFileName = null;
            if ($request->hasFile('categoryImage')) {
                $file = $request->file('categoryImage');
                $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();

                // Almacenar el archivo
                $file->storeAs('public/subcategory', $uniqueFileName);
            }

            // Obtener otros datos del formulario
            $nameCategory = $request->input('categoryTitle');
            $descriptionCategory = $request->input('description');
            $category_id = $request->input('category_id');
            $tinit = $request->input('time_init');
            $tfinish = $request->input('time_finish');
            $statusCategory = 1; // Asignar un estado predeterminado, en este caso 'active'

            // Realizar el insert en la base de datos utilizando Eloquent (suponiendo que tengas un modelo Category)
            $subcategory = new SubCategories();
            $subcategory->name_subcategory = "$nameCategory";
            $subcategory->descr_subcategory = $descriptionCategory;
            $subcategory->img_subcategory = $uniqueFileName;
            $subcategory->status_subcategory = $statusCategory;
            $subcategory->time_init = $tinit;
            $subcategory->time_finish = $tfinish;
            $subcategory->category_id = $category_id;
            $subcategory->save();

            // Retornar una respuesta JSON con los datos insertados
            return response()->json([
                'message' => 'Category inserted successfully',
                'data' => [
                    'name_category' => $nameCategory,
                    'descr_category' => $descriptionCategory,
                    'img_category' => $uniqueFileName,
                    'status_category' => $statusCategory
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error en el servidor: ' . $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request)
    {
        try {
            $categoryId = $request->input('categoryId');

            $subcategory = SubCategories::findOrFail($categoryId);

            $nameCategory = $request->input('categoryTitle');
            $descriptionCategory = $request->input('description');
            $category_id = $request->input('category_id');
            $tinit = $request->input('time_init');
            $tfinish = $request->input('time_finish');

            if ($request->hasFile('categoryImage')) {
                $file = $request->file('categoryImage');
                $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();

                $file->storeAs('public/subcategory', $uniqueFileName);

                $subcategory->img_subcategory = $uniqueFileName;
            }

            $subcategory->name_subcategory = $nameCategory;
            $subcategory->category_id  = $category_id;
            $subcategory->descr_subcategory = $descriptionCategory;
            $subcategory->time_init = $tinit;
            $subcategory->time_finish = $tfinish;

            $subcategory->save();

            return response()->json([
                'message' => 'Category updated successfully',
                'data' => [
                    'name_category' => $nameCategory,
                    'descr_category' => $descriptionCategory,
                    'status_category' => $subcategory->status_category
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error en el servidor: ' . $e->getMessage()
            ], 500);
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');

            $category = SubCategories::findOrFail($id);
            $category->status_subcategory = $status;
            $category->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la categoría.'], 404);
        }
    }

    public function selectSubCategory(Request $request)
    {
        $categoryId = $request->input('category_id');

        $subcategories = SubCategories::sltcsubCategories($categoryId);

        return response()->json($subcategories);
    }
}
