<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthCustomerRequest;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\CustomerLoginRequest;
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
    public function processLogin(CustomerLoginRequest  $request)
    {
        try {
            $user = Customer::query()
                ->where('email', $request->get('email'))
                ->orwhere('phone', $request->get('email'))
                ->firstOrFail();
            if (!Hash::check($request->get('password'), $user->password)) {
                throw new Exception('Invalid password');
            }
            session()->put('id', $user->id);
            session()->put('name', $user->name);
            session()->put('avatar', $user->avatar);
            return response()->json('success', 200);
        } catch (Throwable $e) {
            return response()->json([
                'errors' => 'Tài khoản hoặc mật khẩu không đúng',
            ], 400);
        }
    }

    public function logOut()
    {
        session()->forget('id');
        session()->forget('name');
        session()->forget('avatar');
        return redirect()->route('home.index');

    }

    public function register()
    {
        return view('home.register');
    }

    public function processRegister(AuthCustomerRequest $request)
    {
        $register = $request->validated();
        $arr = [];
        $arr['name'] = $register['name'];
        $arr['email'] = $register['email'];
        $arr['password'] =Hash::make($request->get('password'),[
            'rounds' => 12,
        ]);
        Customer::query()->create($arr);

        return response()->json('success',200);
    }
}
