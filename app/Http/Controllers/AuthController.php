<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Member;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.index');
    }

    public function processLogin(AuthRequest $request)
    {
        try {
            $user = Member::query()
                ->where('username', $request->get('username'))
                ->firstOrFail();
            if (!Hash::check($request->get('password'), $user->password)) {
                throw new Exception('Invalid password');
            }
            session()->put('id', $user->id);
            session()->put('name', $user->name);
            session()->put('role_id', $user->role_id);
            session()->put('avatar', $user->avatar);
            $role = Role::query()->where('id', $user->role_id)->first();
            session()->put('role_name', $role->name);
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
        return redirect()->route('login');

    }

    public function register()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {

    }
}
