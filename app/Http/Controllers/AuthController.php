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
            session()->put('admin_id', $user->id);
            session()->put('admin_name', $user->name);
            session()->put('role_id', $user->role_id);
            session()->put('admin_avatar', $user->avatar);
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
        session()->forget('admin_id');
        session()->forget('admin_name');
        session()->forget('role_id');
        session()->forget('admin_avatar');
        session()->forget('role_name');
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
