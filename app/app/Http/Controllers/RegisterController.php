<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    function showRegisterForm()
    {
        return view('register');
    }
    function register(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'passwd' => 'required',
            'passwdagain' => 'required'

        ], [
            'username.required' => 'El campo "username" es obligatorio jefe.',
            'email.required' => 'El campo "email" es obligatorio jefe.',
            'passwd.required' => 'El campo "password" es obligatorio jefe.',
            'passwdagain.required' => 'Campo obligatorio y debe ser igual al anterior'
        ]);

        //buscaremos si existe algun usuario con ese mismo nombre.
        $user = Usuario::where('nombre', $credentials['username'])->get();
        if (isset($user[0])) return view('register');

        //buscaremos si existe algun usuario con ese mismo correo electrónico.
        $user = Usuario::where('correo_electronico', $credentials['email'])->get();
        if (isset($user[0])) return view('register');

        //comprobamos que las contraseñas correspondan.
        if ($credentials['passwd'] != $credentials['passwdagain']) return view('register');

        $hashedPassword = Hash::make($request->input('passwd'));
        $user = new Usuario();
        $user->nombre = $request->input("username");
        $user->correo_electronico = $request->input("email");
        $user->contrasena = $hashedPassword;
        $user->save();

        $fulluser = DB::table('USUARIO')->where('nombre', $request->input("username"))->first();

        DB::table('NOTIFICACION')->insert([
            'ID_usuario' => $fulluser->ID_usuario,
            'emisor' => null,
            'objetivo_post' => null,
            'tipo' => 'register'
        ]);

        return redirect()->route('login');
    }
}
