<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $data['title'] = "Cliente";
        return view('admin.client.index', $data);
    }
}
