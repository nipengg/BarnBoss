<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = User::where('role', 2)->get();

        return view('admin.seller.index', ['sellers' => $sellers]);
    }

    public function create()
    {
        return view('auth.register-seller');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name' => 'string|max:255',
            'email'=> 'string|max:255|unique:users',
            'phone' => 'string|max:12|unique:users',
            'password' => 'string|max:255',
        ]);

        if($data['password'] != $data['password_confirmation']) {
            return redirect()->route('seller.create')->with('error_message', 'Password does not match');
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 2,
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('login')->with('success_message', 'Success!');
    }

    public function edit($id)
    {
        $seller = User::findOrFail($id);

        return view('admin.seller.edit', ['seller' => $seller]);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'email'=> 'string|max:255|unique:users,email,' . $user->id,
            'phone' => 'string|max:12|unique:users,phone,' . $user->id,
        ]);

        $item = User::findOrFail($id);
        $item->update($data);

        return redirect()->route('seller')->with('success_message', 'Update Success!');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('seller')->with('success_message', 'Delete Success!');;
    }
}
