<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Throwable;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.index');
    }

    public function processLogin(Request $request)
    {
      try {
          $user = Member::query()
              ->where('username', $request->get('username'))
              ->where('password', $request->get('password'))
              ->firstOrFail();

          session()->put('id',$user->id);
          session()->put('name',$user->name);
          session()->put('roles_id',$user->roles_id);

          return redirect()->route('members.index');
      } catch (Throwable $e) {
          return redirect()->route('login');
      }

    }

    public function logOut()
    {
        session()->flush();
        return redirect()->route('login');

    }
}
