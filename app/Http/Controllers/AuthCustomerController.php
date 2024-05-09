<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Customer;
use App\Models\Member;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthCustomerController extends Controller
{
    // page login for customer
    public function login()
    {
        return view('home.signup');
    }
    //  handle process login from customer
    public function processLogin(Request $request)
    {
        try {
            $user = Customer::query()
                ->where('email', $request->get('email'))->firstOrFail();
            if (!Hash::check($request->get('password'), $user->password)) {
                throw new Exception('Invalid password');
            }
            session()->put('id', $user->id);
            session()->put('name', $user->name);
            session()->put('avatar', $user->avatar);
            return response()->json('success', 200);
        } catch (Throwable $e) {
            return response()->json([
                'errors' => 'Account or password incorrect',
            ], 400);
        }
    }

    public function logOut()
    {
        session()->flush();
        return redirect()->route('home.index');

    }

    public function register()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {

    }
}
