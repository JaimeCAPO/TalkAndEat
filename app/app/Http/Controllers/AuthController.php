<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'username' => 'required',
            'passwd' => 'required'
        ], [
            'username.required' => 'El campo "username" es obligatorio jefe.',
            'passwd.required' => 'El campo "password" es obligatorio jefe.'
        ]);

        $user = Usuario::where('nombre', $credentials['username'])->get();

        if (isset($user[0])) {
            $hashedPassword = $user[0]['contrasena'];

            if (Hash::check($credentials['passwd'], $hashedPassword)) {
                $request->session()->put('username', $credentials['username']);
                Auth::login($user[0]);

                return redirect()->route('home');
            } else {
                return view('login');
            }
        } else return view('login');
    }


    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return view('login');
    }
}
