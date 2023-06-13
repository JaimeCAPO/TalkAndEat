<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function showConfigForm()
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $me = $usuario->ID_usuario;
            $username = $usuario->nombre;
        }
        return view('config', ['id' => $me, "username" => $username]);
    }

    public function updateUser(Request $request)
    {

        if (Auth::check()) {
            $usuario = Auth::user();
            $me = $usuario->ID_usuario;
            $username = $usuario->nombre;
            $passwd = $usuario->contrasena;
            $email = $usuario->correo_electronico;
            $bio = $usuario->biografia;
            $img = $usuario->foto_perfil;
        }

        $url = 'http://api.talkandeat.es/api/user';
        $params = [
            'ID_usuario' => $me,
            'nombre' => $request['username'] ? $request['username'] : $username,
            'contrasena' => $passwd,
            'correo_electronico' => $email,
            'biografia' => $request['bio'] ? $request['bio'] : $bio,
            'foto_perfil' => $request['img'] ? $request['img'] : $img,
        ];
        $body = json_encode($params);
        $headers = ['Content-Type' => 'application/json'];

        $response = Http::withHeaders($headers)
            ->withBody($body, 'application/json')
            ->put($url);

        if ($response->successful()) {
            // La solicitud fue exitosa, puedes realizar alguna acción aquí
            return redirect()->route('account');
        } else {
            // La solicitud falló, puedes manejar el error aquí
            return back()->with('error', 'Hubo un problema al agregar el comentario');
        }
    }

    public function deleteUser(Request $request)
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $me = $usuario->ID_usuario;
            Auth::logout();
        }

        $url = 'http://api.talkandeat.es/api/deleteUser';
        $params = [
            'ID_usuario' => $me ? $me : null,
        ];
        $body = json_encode($params);
        $headers = ['Content-Type' => 'application/json'];

        $response = Http::withHeaders($headers)
            ->withBody($body, 'application/json')
            ->delete($url);

        if ($response->successful()) {
            // La solicitud fue exitosa, puedes realizar alguna acción aquí
            return view('login');
        } else {
            // La solicitud falló, puedes manejar el error aquí
            return back()->with('error', 'Hubo un problema al agregar el comentario');
        }
    }
}
