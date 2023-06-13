<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class mainController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $id = $usuario['ID_usuario'];
        }
        return view('home', ['id' => $id]);
    }

    public function explore()
    {
        return view('explore');
    }

    public function admin()
    {
        return view('admin');
    }

    public function notifications()
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $me = $usuario['ID_usuario'];
        }
        return view('notifications', ['me' => $me]);
    }

    public function account()
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $id = $usuario['ID_usuario'];
            $username = $usuario['nombre'];
            $descripcion = $usuario['biografia'];
        }
        return view('account', ['id' => $id, 'username' => $username, 'descripcion' => $descripcion]);
    }

    public function user($id)
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $me = $usuario['ID_usuario'];
            if ($me == $id) return redirect()->route('account');
        }
        $response = Http::get('api.talkandeat.es/api/users?id=' . $id);
        $data = $response->json();

        $response = Http::get('http://api.talkandeat.es/api/isfollow?ID_usuario_seguidor=' . $me . '&ID_usuario_seguido=' . $id);
        $datafollow = $response->json();
        $follow = false;
        if ($datafollow['code'] == 200) $follow = true;
        if (isset($data['ID_usuario'])) return view('account', ['id' => $data['ID_usuario'], 'username' => $data['nombre'], 'descripcion' => $data['biografia'], 'follow' => $follow]);
        else if ($data['code'] == 404) return view('error404');
        else return view('error400');
    }

    public function error404()
    {
        return view('error404');
    }

    public function error400()
    {
        return view('error400');
    }
}
