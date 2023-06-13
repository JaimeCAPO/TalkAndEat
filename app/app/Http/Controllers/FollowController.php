<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function deletefollow(Request $request)
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $me = $usuario->ID_usuario;
        }

        $url = 'http://api.talkandeat.es/api/deleteFollow';
        $params = [
            'ID_usuario_seguidor' => $me,
            'ID_usuario_seguido' => $request->input('id')

        ];

        $body = json_encode($params);
        $headers = ['Content-Type' => 'application/json'];

        $response = Http::withHeaders($headers)
            ->withBody($body, 'application/json')
            ->delete($url);


        if ($response->successful()) {
            // La solicitud DELETE se realizó correctamente
        } else {
            // Hubo un error al realizar la solicitud DELETE
        }

        $response = Http::get('api.talkandeat.es/api/users/' . $request->input('id'));
        $data = $response->json();

        $response = Http::get('http://api.talkandeat.es/api/isfollow?ID_usuario_seguidor=' . $me . '&ID_usuario_seguido=' . $request->input('id'));
        $datafollow = $response->json();
        $follow = false;
        if ($datafollow['code'] == 200) $follow = true;
        return view('account', ['id' => $data['ID_usuario'], 'username' => $data['nombre'], 'descripcion' => $data['biografia'], 'follow' => $follow]);
    }

    public function follow(Request $request)
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $me = $usuario->ID_usuario;
        }

        $url = 'http://api.talkandeat.es/api/follow';
        $params = [
            'ID_usuario_seguidor' => $me,
            'ID_usuario_seguido' => $request->input('id')

        ];

        $body = json_encode($params);
        $headers = ['Content-Type' => 'application/json'];

        $response = Http::withHeaders($headers)
            ->withBody($body, 'application/json')
            ->post($url);


        if ($response->successful()) {
            // La solicitud DELETE se realizó correctamente
        } else {
            // Hubo un error al realizar la solicitud DELETE
        }

        $response = Http::get('api.talkandeat.es/api/users/' . $request->input('id'));
        $data = $response->json();

        $response = Http::get('http://api.talkandeat.es/api/isfollow?ID_usuario_seguidor=' . $me . '&ID_usuario_seguido=' . $request->input('id'));
        $datafollow = $response->json();
        $follow = false;
        if ($datafollow['code'] == 200) $follow = true;
        return view('account', ['id' => $data['ID_usuario'], 'username' => $data['nombre'], 'descripcion' => $data['biografia'], 'follow' => $follow]);
    }
}
