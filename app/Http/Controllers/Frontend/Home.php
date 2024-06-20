<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Categories;
use App\Models\Admin\SubCategories;

class Home extends Controller
{
    public function index()
    {
        $data['title'] = "Inicio";
        $data['categories'] = Categories::with('subcategories')->get();
        return view('frontend/home', $data);
    }
}
