<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $data['roles'] = Role::all();
        return view('admin.users.index', $data);
    }

    public function show()
    {
        $data = User::all();
        return response()->json(['data' => $data]);
    }
    public function update(Request $request)
    {
        $user = $request->input('id');
        $user->roles->sync($request->input('user-rol'));
    }
}
