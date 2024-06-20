<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $data['title'] = "Contacto";
        return view('admin.category.index', $data);
    }

    public function show()
    {
        $categoriesData = Categories::getAllCategories();
        return response()->json(['data' => $categoriesData]);
    }

    public function new(Request $request)
    {
        try {
            // Validación de entrada
            $validatedData = $request->validate([
                'categoryImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'categoryTitle' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
            ]);

            // Inicialización de variables
            $uniqueFileName = null;
            if ($request->hasFile('categoryImage')) {
                $file = $validatedData['categoryImage'];
                $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();

                // Almacenar el archivo
                $file->storeAs('public/category', $uniqueFileName);
            }

            // Preparar datos de la categoría
            $nameCategory = $validatedData['categoryTitle'];
            $descriptionCategory = $validatedData['description'] ?? '';
            $statusCategory = 1;

            // Crear nueva categoría
            $category = new Categories();
            $category->name_category = $nameCategory;
            $category->descr_category = $descriptionCategory;
            if ($uniqueFileName) {
                $category->img_category = $uniqueFileName;
            }
            $category->status_category = $statusCategory;
            $category->save();

            return response()->json([
                'message' => 'Category inserted successfully',
                'data' => [
                    'name_category' => $nameCategory,
                    'descr_category' => $descriptionCategory,
                    'img_category' => $uniqueFileName,
                    'status_category' => $statusCategory
                ]
            ], 201); // 201 Created
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation error: ' . $e->getMessage(),
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request)
    {
        try {
            $categoryId = $request->input('categoryId');

            $category = Categories::findOrFail($categoryId);

            $nameCategory = $request->input('categoryTitle');
            $descriptionCategory = $request->input('description');

            if ($request->hasFile('categoryImage')) {
                $file = $request->file('categoryImage');
                $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();

                $file->storeAs('public/category', $uniqueFileName);

                $category->img_category = $uniqueFileName;
            }

            $category->name_category = $nameCategory;
            $category->descr_category = $descriptionCategory;

            $category->save();

            return response()->json([
                'message' => 'Category updated successfully',
                'data' => [
                    'name_category' => $nameCategory,
                    'descr_category' => $descriptionCategory,
                    'status_category' => $category->status_category
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

            $category = Categories::findOrFail($id);
            $category->status_category = $status;
            $category->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la categoría.'], 404);
        }
    }

    public function selectCategory()
    {
        return Categories::getSelectCategories();
    }
}
