<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use App\Models\Paso;
use App\Models\Publicacion;
use App\Models\PubliIngre;
use App\Models\Seguidor;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPostController extends Controller
{

    /*
        id_publicacion
        id_usuario
        titulo
        descripcion
        pasos
        ingredientes
        imagen 
        duracion 
        dificultad
    */
    public function addPost(Request $request)
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            $data = $request->json()->all();

            $postId = DB::table('PUBLICACION')->insertGetId([
                'ID_usuario' => $data['ID_usuario'],
                'titulo' => $data['titulo'],
                'descripcion' => $data['descripcion'],
                'imagen' => $data['imagen'],
                'duracion' => $data['duracion'],
                'dificultad' => $data['dificultad'],
            ]);

            foreach ($data['ingredientes'] as $ingrediente) {
                $existingIngredient = DB::table('INGREDIENTE')->where('nombre', $ingrediente['nombre'])->first();

                if ($existingIngredient) {
                    $ingredientId = $existingIngredient->ID_ingrediente;
                } else {
                    $ingredientId = DB::table('INGREDIENTE')->insertGetId([
                        'nombre' => $ingrediente['nombre'],
                    ]);
                }

                DB::table('PUBLICACION_INGREDIENTE')->insert([
                    'ID_publicacion' => $postId,
                    'ID_ingrediente' => $ingredientId,
                    'unidad' => $ingrediente['unidad'],
                    'cantidad' => $ingrediente['cantidad'],
                ]);
            }

            foreach ($data['pasos'] as $paso) {
                DB::table('PUBLICACION_PASO')->insert([
                    'ID_publicacion' => $postId,
                    'orden' => $paso['orden'],
                    'texto' => $paso['texto'],
                ]);
            }


            DB::table('NOTIFICACION')->insert([
                'ID_usuario' => $data['ID_usuario'],
                'emisor' => null,
                'objetivo_post' => $postId,
                'tipo' => 'post'
            ]);

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function addFollow(Request $request)
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            $data = $request->json()->all();

            DB::table('SEGUIDOR')->insert([
                'ID_usuario_seguido' => $data['ID_usuario_seguido'],
                'ID_usuario_seguidor' => $data['ID_usuario_seguidor'],
                'estado' => 1
            ]);

            DB::table('NOTIFICACION')->insert([
                'ID_usuario' => $data['ID_usuario_seguido'],
                'emisor' => $data['ID_usuario_seguidor'],
                'objetivo_post' => null,
                'tipo' => 'follow'
            ]);

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function addLike(Request $request)
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            $data = $request->json()->all();

            DB::table('LIKES')->insert([
                'ID_usuario' => $data['ID_usuario'],
                'ID_publicacion' => $data['ID_publicacion']
            ]);

            $recipe = DB::table('PUBLICACION')->where('ID_publicacion', $data['ID_publicacion'])->first();

            DB::table('NOTIFICACION')->insert([
                'ID_usuario' => $recipe->ID_usuario,
                'emisor' => $data['ID_usuario'],
                'objetivo_post' => $data['ID_publicacion'],
                'tipo' => 'like'
            ]);

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function deletePost(Request $request)
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            $data = $request->json()->all();
            $id_publicacion = $data['ID_publicacion'];

            $recipe = DB::table('PUBLICACION')->where('ID_publicacion', $data['ID_publicacion'])->first();

            DB::beginTransaction();

            DB::table('COMENTARIO')->where('ID_publicacion', $id_publicacion)->delete();

            DB::table('PUBLICACION_PASO')->where('ID_publicacion', $id_publicacion)->delete();

            DB::table('PUBLICACION_INGREDIENTE')->where('ID_publicacion', $id_publicacion)->delete();

            DB::table('PUBLICACION')->where('ID_publicacion', $id_publicacion)->delete();

            DB::commit();

            DB::table('NOTIFICACION')->insert([
                'ID_usuario' => $recipe->ID_usuario,
                'emisor' => null,
                'objetivo_post' => null,
                'tipo' => 'delete_post'
            ]);

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {
            DB::rollBack();
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function deleteUser(Request $request)
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            $data = $request->json()->all();
            $id_usuario = $data['ID_usuario'];
            if ($id_usuario == 10) {
                $response['status'] = 1;
                $response['msg'] = 'Action not allowed.';
                $response['code'] = 403;
                return response()->json($request);
            }
            DB::beginTransaction();

            // Eliminar las publicaciones del usuario
            $publicaciones = DB::table('PUBLICACION')->where('ID_usuario', $id_usuario)->pluck('ID_publicacion');
            foreach ($publicaciones as $id_publicacion) {
                DB::table('COMENTARIO')->where('ID_publicacion', $id_publicacion)->delete();
                DB::table('PUBLICACION_PASO')->where('ID_publicacion', $id_publicacion)->delete();
                DB::table('PUBLICACION_INGREDIENTE')->where('ID_publicacion', $id_publicacion)->delete();
            }

            DB::table('PUBLICACION')->where('ID_usuario', $id_usuario)->delete();
            DB::table('NOTIFICACION')->where('ID_usuario', $id_usuario)->delete();
            DB::table('LIKES')->where('ID_usuario', $id_usuario)->delete();
            DB::table('USUARIO')->where('ID_usuario', $id_usuario)->delete();


            DB::commit();

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {

            DB::rollBack();
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function deleteFollow(Request $request)
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            $data = $request->json()->all();
            $id_usuario_seguidor = $data['ID_usuario_seguidor'];
            $id_usuario_seguido = $data['ID_usuario_seguido'];

            DB::beginTransaction();

            DB::table('SEGUIDOR')->where('ID_usuario_seguidor', $id_usuario_seguidor)
                ->where('ID_usuario_seguido', $id_usuario_seguido)
                ->delete();

            DB::commit();

            DB::table('NOTIFICACION')->insert([
                'ID_usuario' => $id_usuario_seguido,
                'emisor' => $id_usuario_seguidor,
                'objetivo_post' => null,
                'tipo' => 'delete_follow',
                'visible' => 0
            ]);

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {
            DB::rollBack();
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function deleteLike(Request $request)
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            $data = $request->json()->all();

            DB::table('LIKES')
                ->where('ID_usuario', $data['ID_usuario'])
                ->where('ID_publicacion', $data['ID_publicacion'])
                ->delete();

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function addComment(Request $request)
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            $data = $request->json()->all();

            DB::table('COMENTARIO')->insert([
                'ID_publicacion' => $data['ID_publicacion'],
                'ID_usuario' => $data['ID_usuario'],
                'texto' => $data['texto']
            ]);

            $recipe = DB::table('PUBLICACION')->where('ID_publicacion', $data['ID_publicacion'])->first();

            DB::table('NOTIFICACION')->insert([
                'ID_usuario' => $recipe->ID_usuario,
                'emisor' => $data['ID_usuario'],
                'objetivo_post' => $data['ID_publicacion'],
                'tipo' => 'comment'
            ]);

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function deleteNotifications()
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            DB::table('NOTIFICACION')->truncate();

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function updateUsuario(Request $request)
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            $data = $request->json()->all();

            DB::table('USUARIO')
                ->where('ID_usuario', $request['ID_usuario'])
                ->update([
                    'nombre' => $data['nombre'],
                    'contrasena' => $data['contrasena'],
                    'correo_electronico' => $data['correo_electronico'],
                    'biografia' => $data['biografia'],
                    'foto_perfil' => $data['foto_perfil']
                ]);

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function updateNotification(Request $request)
    {
        $response = ['status' => 0, 'msg' => 'Failed'];

        try {
            $data = $request->json()->all();
            $id_notificacion = $data['ID_notificacion'];

            DB::beginTransaction();

            DB::table('NOTIFICACION')
                ->where('ID_notificacion', $id_notificacion)
                ->update(['visible' => 0]);

            DB::commit();

            $response['status'] = 1;
            $response['msg'] = 'Ok';
            $response['code'] = 200;
        } catch (\Exception $e) {
            DB::rollBack();
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
