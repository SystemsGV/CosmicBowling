<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $data['title'] = "Cliente";
        return view('admin.client.index', $data);
    }

    public function show()
    {
        $clients = Client::getClients();
        return response()->json(['data' => $clients]);
    }
}
