<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function newpost()
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $me = $usuario->ID_usuario;
        }

        return view('newpost', ['me' => $me]);
    }

    public function post($id)
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $me = $usuario->ID_usuario;
        }
        $response = Http::get('api.talkandeat.es/api/posts?id=' . $id);
        $data = $response->json();

        if (isset($data['ID_publicacion']))  return view('recipe', ['me' => $me]);
        else if ($data['code'] == 404) return view('error404');
        else return view('error400');
    }

    public function comment(Request $request)
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $me = $usuario->ID_usuario;
        }

        $url = 'http://api.talkandeat.es/api/comment';
        $params = [
            'ID_publicacion' => $request['id'],
            'ID_usuario' => $me,
            'texto' => $request['msg']

        ];

        $body = json_encode($params);
        $headers = ['Content-Type' => 'application/json'];

        $response = Http::withHeaders($headers)
            ->withBody($body, 'application/json')
            ->post($url);

        if ($response->successful()) {
            // La solicitud fue exitosa, puedes realizar alguna acción aquí
            return view('recipe', ['me' => $me]);
        } else {
            // La solicitud falló, puedes manejar el error aquí
            return back()->with('error', 'Hubo un problema al agregar el comentario');
        }
    }
}
