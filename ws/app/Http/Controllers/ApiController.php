<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Ingrediente;
use App\Models\Like;
use App\Models\Notificacion;
use App\Models\Paso;
use App\Models\Publicacion;
use App\Models\PubliIngre;
use App\Models\Seguidor;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    function users(Request $request)
    {
        $response = ['status' => 0, 'msg' => ''];
        if ($request->has('email')) {
            if ($request->email) {
                $users = Usuario::where("correo_electronico", $request->email)->first();
                if ($users) {
                    $follows = Seguidor::where('ID_usuario_seguidor', $users['ID_usuario'])->where('estado', 1)->get();
                    $users['seguidos'] = count($follows);
                    $followers = Seguidor::where('ID_usuario_seguido', $users['ID_usuario'])->where('estado', 1)->get();
                    $users['seguidores'] = count($followers);
                } else {
                    $response['msg'] = "Usuario no encontrado";
                    $response['code'] = 404;
                }
            }
        } else if ($request->has('username')) {
            if ($request->username) {
                $users = Usuario::where("nombre", $request->username)->first();
                if ($users) {
                    $follows = Seguidor::where('ID_usuario_seguidor', $users['ID_usuario'])->where('estado', 1)->get();
                    $users['seguidos'] = count($follows);
                    $followers = Seguidor::where('ID_usuario_seguido', $users['ID_usuario'])->where('estado', 1)->get();
                    $users['seguidores'] = count($followers);
                } else {
                    $response['msg'] = "Usuario no encontrado";
                    $response['code'] = 404;
                }
            }
        } else if ($request->has('id')) {
            if (!is_numeric($request->id)) {
                $users = [];
                $response['msg'] = "ID invalida o no proporcionada";
                $response['code'] = 400;
            } else {

                $users = Usuario::where("ID_usuario", $request->id)->first();
                if ($users) {
                    $follows = Seguidor::where('ID_usuario_seguidor', $users['ID_usuario'])->where('estado', 1)->get();
                    $users['seguidos'] = count($follows);
                    $followers = Seguidor::where('ID_usuario_seguido', $users['ID_usuario'])->where('estado', 1)->get();
                    $users['seguidores'] = count($followers);
                } else {
                    $response['msg'] = "Usuario no encontrado";
                    $response['code'] = 404;
                }
            }
        } else {
            $users = Usuario::all();
            foreach ($users as $user) {
                $follows = Seguidor::where('ID_usuario_seguidor', $user['ID_usuario'])->where('estado', 1)->get();
                $user['seguidos'] = count($follows);
                $followers = Seguidor::where('ID_usuario_seguido', $user['ID_usuario'])->where('estado', 1)->get();
                $user['seguidores'] = count($followers);
            }
        }

        if ($users) return response()->json($users);
        else return response()->json($response);
    }

    function posts(Request $request)
    {

        $response = ['status' => 0, 'msg' => 'Invalid parameters', 'code' => 400];

        $recipes = [];

        if ($request->has('id')) {
            if (!is_numeric($request->id)) {
                $recipes = [];
                $response['msg'] = "ID invalida o no proporcionada";
                $response['code'] = 400;
            } else {
                $recipes = [];
                $post = Publicacion::where("ID_publicacion", $request->id)->first();
                if ($post) {
                    $countLikes = Like::where('ID_publicacion', $post['ID_publicacion'])
                        ->count();
                    $recipes = [
                        'ID_publicacion' => $post['ID_publicacion'],
                        'ID_usuario' => $post['ID_usuario'],
                        'titulo' => $post['titulo'],
                        'descripcion' => $post['descripcion'],
                        'pasos' => [],
                        'ingredientes' => [],
                        'imagen' => $post['imagen'],
                        'duracion' => $post['duracion'],
                        'dificultad' => $post['dificultad'],
                        'comentarios' => [],
                        'likes' => $countLikes
                    ];
                    $steps = Paso::where('ID_publicacion', $post['ID_publicacion'])->get();
                    $pasos = [];
                    foreach ($steps as $step) {
                        $object = [
                            'ID_paso' => $step['ID_paso'],
                            'orden' => $step['orden'],
                            'texto' => $step['texto'],
                        ];
                        $pasos[] = $object;
                    }
                    $recipes['pasos'] = $pasos;

                    $ingredients = PubliIngre::where('ID_publicacion', $post['ID_publicacion'])->get();
                    $ingredientes = [];
                    foreach ($ingredients as $ingredient) {
                        $ingredientecomp = Ingrediente::where('ID_ingrediente', $ingredient['ID_ingrediente'])->first();
                        if ($ingredient['unidad'] == 'x') {
                            $object = [
                                'nombre' => $ingredientecomp['nombre'],
                                'unidad' => $ingredientecomp['nombre'],
                                'cantidad' => $ingredient['cantidad'],
                            ];
                        } else {
                            $object = [
                                'nombre' => $ingredientecomp['nombre'],
                                'unidad' => $ingredient['unidad'],
                                'cantidad' => $ingredient['cantidad'],
                            ];
                        }

                        $ingredientes[] = $object;
                    };

                    $comments = Comentario::where('ID_publicacion', $post['ID_publicacion'])->get();
                    $commentsformated = [];
                    foreach ($comments as $comment) {
                        $user = Usuario::where('ID_usuario', $comment['ID_usuario'])->first();
                        $object = [
                            'username' => $user['nombre'],
                            'profile_img' => $user['imagen'],
                            'texto' => $comment['texto'],
                        ];
                        $commentsformated[] = $object;
                    }
                    $recipes['comentarios'] = $commentsformated;
                    $recipes['ingredientes'] = $ingredientes;
                } else {
                    $response['msg'] = "Publicacion no encontrada";
                    $response['code'] = 404;
                }
            }
        } elseif ($request->has('dificultad')) {
            if (is_numeric($request->dificultad)) {
                $recipes = [];
                $response['msg'] = "ID invalida o no proporcionada";
                $response['code'] = 400;
            } else {
                $dificultad = $request->dificultad;
                $posts = Publicacion::where("dificultad", $dificultad)->get()->toArray();
                if (isset($posts)) {
                    $response['msg'] = "Publicacion no encontrada";
                    $response['code'] = 404;
                }
                foreach ($posts as $post) {
                    $countLikes = Like::where('ID_publicacion', $post['ID_publicacion'])
                        ->count();
                    $recipe = [
                        'ID_publicacion' => $post['ID_publicacion'],
                        'ID_usuario' => $post['ID_usuario'],
                        'titulo' => $post['titulo'],
                        'descripcion' => $post['descripcion'],
                        'pasos' => [],
                        'ingredientes' => [],
                        'imagen' => $post['imagen'],
                        'duracion' => $post['duracion'],
                        'dificultad' => $post['dificultad'],
                        'comentarios' => [],
                        'likes' => $countLikes

                    ];
                    $steps = Paso::where('ID_publicacion', $post['ID_publicacion'])->get();
                    $pasos = [];
                    foreach ($steps as $step) {
                        $object = [
                            'ID_paso' => $step['ID_paso'],
                            'orden' => $step['orden'],
                            'texto' => $step['texto'],
                        ];
                        $pasos[] = $object;
                    }
                    $recipe['pasos'] = $pasos;

                    $ingredients = PubliIngre::where('ID_publicacion', $post['ID_publicacion'])->get();
                    $ingredientes = [];
                    foreach ($ingredients as $ingredient) {
                        $ingredientecomp = Ingrediente::where('ID_ingrediente', $ingredient['ID_ingrediente'])->first();
                        if ($ingredient['unidad'] == 'x') {
                            $object = [
                                'nombre' => $ingredientecomp['nombre'],
                                'unidad' => $ingredientecomp['nombre'],
                                'cantidad' => $ingredient['cantidad'],
                            ];
                        } else {
                            $object = [
                                'nombre' => $ingredientecomp['nombre'],
                                'unidad' => $ingredient['unidad'],
                                'cantidad' => $ingredient['cantidad'],
                            ];
                        }

                        $ingredientes[] = $object;
                    };
                    $comments = Comentario::where('ID_publicacion', $post['ID_publicacion'])->get();
                    $commentsformated = [];
                    foreach ($comments as $comment) {
                        $user = Usuario::where('ID_usuario', $comment['ID_usuario'])->first();
                        $object = [
                            'username' => $user['nombre'],
                            'profile_img' => $user['imagen'],
                            'texto' => $comment['texto'],
                        ];
                        $commentsformated[] = $object;
                    }
                    $recipe['comentarios'] = $commentsformated;
                    $recipe['ingredientes'] = $ingredientes;
                    $recipes[] = $recipe;
                }
            }
        } else {
            $recipes = [];
            $posts = Publicacion::all();
            foreach ($posts as $post) {
                $countLikes = Like::where('ID_publicacion', $post['ID_publicacion'])
                    ->count();
                $recipe = [
                    'ID_publicacion' => $post['ID_publicacion'],
                    'ID_usuario' => $post['ID_usuario'],
                    'titulo' => $post['titulo'],
                    'descripcion' => $post['descripcion'],
                    'pasos' => [],
                    'ingredientes' => [],
                    'imagen' => $post['imagen'],
                    'duracion' => $post['duracion'],
                    'dificultad' => $post['dificultad'],
                    'comentarios' => [],
                    'likes' => $countLikes

                ];
                $steps = Paso::where('ID_publicacion', $post['ID_publicacion'])->get();
                $pasos = [];
                foreach ($steps as $step) {
                    $object = [
                        'ID_paso' => $step['ID_paso'],
                        'orden' => $step['orden'],
                        'texto' => $step['texto'],
                    ];
                    $pasos[] = $object;
                }
                $recipe['pasos'] = $pasos;

                $ingredients = PubliIngre::where('ID_publicacion', $post['ID_publicacion'])->get();
                $ingredientes = [];
                foreach ($ingredients as $ingredient) {
                    $ingredientecomp = Ingrediente::where('ID_ingrediente', $ingredient['ID_ingrediente'])->first();
                    if ($ingredient['unidad'] == 'x') {
                        $object = [
                            'nombre' => $ingredientecomp['nombre'],
                            'unidad' => $ingredientecomp['nombre'],
                            'cantidad' => $ingredient['cantidad'],
                        ];
                    } else {
                        $object = [
                            'nombre' => $ingredientecomp['nombre'],
                            'unidad' => $ingredient['unidad'],
                            'cantidad' => $ingredient['cantidad'],
                        ];
                    }

                    $ingredientes[] = $object;
                };
                $comments = Comentario::where('ID_publicacion', $post['ID_publicacion'])->get();
                $commentsformated = [];
                foreach ($comments as $comment) {
                    $user = Usuario::where('ID_usuario', $comment['ID_usuario'])->first();
                    $object = [
                        'username' => $user['nombre'],
                        'profile_img' => $user['imagen'],
                        'texto' => $comment['texto'],
                    ];
                    $commentsformated[] = $object;
                }
                $recipe['comentarios'] = $commentsformated;
                $recipe['ingredientes'] = $ingredientes;
                $recipes[] = $recipe;
            }
        }


        if ($recipes) return response()->json($recipes);
        else return response()->json($response);
    }

    function Eightposts(Request $request)
    {
        $response = ['status' => 0, 'msg' => ''];
        $recipes = [];

        $posts = Publicacion::take(8)->inRandomOrder()->get(); // Limitamos la consulta a 8 resultados

        foreach ($posts as $post) {
            $countLikes = Like::where('ID_publicacion', $post['ID_publicacion'])
                ->count();
            $recipe = [
                'ID_publicacion' => $post['ID_publicacion'],
                'ID_usuario' => $post['ID_usuario'],
                'titulo' => $post['titulo'],
                'descripcion' => $post['descripcion'],
                'pasos' => [],
                'ingredientes' => [],
                'imagen' => $post['imagen'],
                'duracion' => $post['duracion'],
                'dificultad' => $post['dificultad'],
                'comentarios' => [],
                'likes' => $countLikes
            ];

            $steps = Paso::where('ID_publicacion', $post['ID_publicacion'])->get();
            $pasos = [];
            foreach ($steps as $step) {
                $object = [
                    'ID_paso' => $step['ID_paso'],
                    'orden' => $step['orden'],
                    'texto' => $step['texto'],
                ];
                $pasos[] = $object;
            }
            $recipe['pasos'] = $pasos;

            $ingredients = PubliIngre::where('ID_publicacion', $post['ID_publicacion'])->get();
            $ingredientes = [];
            foreach ($ingredients as $ingredient) {
                $ingredientecomp = Ingrediente::where('ID_ingrediente', $ingredient['ID_ingrediente'])->first();
                if ($ingredient['unidad'] == 'x') {
                    $object = [
                        'nombre' => $ingredientecomp['nombre'],
                        'unidad' => $ingredientecomp['nombre'],
                        'cantidad' => $ingredient['cantidad'],
                    ];
                } else {
                    $object = [
                        'nombre' => $ingredientecomp['nombre'],
                        'unidad' => $ingredient['unidad'],
                        'cantidad' => $ingredient['cantidad'],
                    ];
                }

                $ingredientes[] = $object;
            };

            $comments = Comentario::where('ID_publicacion', $post['ID_publicacion'])->get();
            $commentsformated = [];
            foreach ($comments as $comment) {
                $user = Usuario::where('ID_usuario', $comment['ID_usuario'])->first();
                $object = [
                    'username' => $user['nombre'],
                    'profile_img' => $user['imagen'],
                    'texto' => $comment['texto'],
                ];
                $commentsformated[] = $object;
            }

            $recipe['comentarios'] = $commentsformated;
            $recipe['ingredientes'] = $ingredientes;
            $recipes[] = $recipe;
        }

        if ($recipes) {
            return response()->json($recipes);
        } else {
            return response()->json($response);
        }
    }

    function GetPostsByKeyword(Request $request)
    {
        $response = ['status' => 0, 'msg' => ''];
        $response['msg'] = "Publicaciones no encontradas";
        $response['code'] = 404;
        $recipes = [];

        if ($request->has('search')) {
            if ($request['search']) {

                $keyword = $request->search;
                $posts = Publicacion::where('titulo', 'LIKE', '%' . $keyword . '%')->get();
                if ($posts != null) {
                    foreach ($posts as $post) {
                        $countLikes = Like::where('ID_publicacion', $post['ID_publicacion'])
                            ->count();
                        $recipe = [
                            'ID_publicacion' => $post['ID_publicacion'],
                            'ID_usuario' => $post['ID_usuario'],
                            'titulo' => $post['titulo'],
                            'descripcion' => $post['descripcion'],
                            'pasos' => [],
                            'ingredientes' => [],
                            'imagen' => $post['imagen'],
                            'duracion' => $post['duracion'],
                            'dificultad' => $post['dificultad'],
                            'comentarios' => [],
                            'likes' => $countLikes
                        ];

                        $steps = Paso::where('ID_publicacion', $post['ID_publicacion'])->get();
                        $pasos = [];
                        foreach ($steps as $step) {
                            $object = [
                                'ID_paso' => $step['ID_paso'],
                                'orden' => $step['orden'],
                                'texto' => $step['texto'],
                            ];
                            $pasos[] = $object;
                        }
                        $recipe['pasos'] = $pasos;

                        $ingredients = PubliIngre::where('ID_publicacion', $post['ID_publicacion'])->get();
                        $ingredientes = [];
                        foreach ($ingredients as $ingredient) {
                            $ingredientecomp = Ingrediente::where('ID_ingrediente', $ingredient['ID_ingrediente'])->first();
                            if ($ingredient['unidad'] == 'x') {
                                $object = [
                                    'nombre' => $ingredientecomp['nombre'],
                                    'unidad' => $ingredientecomp['nombre'],
                                    'cantidad' => $ingredient['cantidad'],
                                ];
                            } else {
                                $object = [
                                    'nombre' => $ingredientecomp['nombre'],
                                    'unidad' => $ingredient['unidad'],
                                    'cantidad' => $ingredient['cantidad'],
                                ];
                            }

                            $ingredientes[] = $object;
                        };

                        $comments = Comentario::where('ID_publicacion', $post['ID_publicacion'])->get();
                        $commentsformated = [];
                        foreach ($comments as $comment) {
                            $user = Usuario::where('ID_usuario', $comment['ID_usuario'])->first();
                            $object = [
                                'username' => $user['nombre'],
                                'profile_img' => $user['imagen'],
                                'texto' => $comment['texto'],
                            ];
                            $commentsformated[] = $object;
                        }

                        $recipe['comentarios'] = $commentsformated;
                        $recipe['ingredientes'] = $ingredientes;
                        $recipes[] = $recipe;
                    }
                }
            } else {
                $response['msg'] = "Invalid Parameters";
                $response['code'] = 400;
            }
        } else {
            $response['msg'] = "Invalid Parameters";
            $response['code'] = 400;
        }


        if ($recipes) {
            return response()->json($recipes);
        } else {
            return response()->json($response);
        }
    }


    function GetUsersByUsername(Request $request)
    {
        $response = ['status' => 0, 'msg' => ''];
        $users = [];

        if ($request->has('search')) {
            if ($request['search']) {
                $username = $request->search;
                $users = Usuario::where('nombre', 'LIKE', '%' . $username . '%')->get();
                if (!Usuario::where('nombre', 'LIKE', '%' . $username . '%')->first()) {
                    $response['msg'] = "Publicaciones no encontradas";
                    $response['code'] = 404;
                    return response()->json($response);
                }

                foreach ($users as $user) {
                    foreach ($users as $user) {
                        $follows = Seguidor::where('ID_usuario_seguidor', $user['ID_usuario'])->where('estado', 1)->get();
                        $user['seguidos'] = count($follows);
                        $followers = Seguidor::where('ID_usuario_seguido', $user['ID_usuario'])->where('estado', 1)->get();
                        $user['seguidores'] = count($followers);
                    }
                }
            } else {
                $response['msg'] = "Invalid Parameters";
                $response['code'] = 400;
            }
        } else {
            $response['msg'] = "Invalid Parameters";
            $response['code'] = 400;
        }

        if ($users) {
            return response()->json($users);
        } else {
            return response()->json($response);
        }
    }

    function user($id)
    {
        $response = ['status' => 0, 'msg' => ''];

        if ($id) {
            if (!is_numeric($id)) {
                $user = [];
                $response['msg'] = "ID invalida o no proporcionada";
                $response['code'] = 400;
            } else {
                $user = Usuario::where("ID_usuario", $id)->first();
                if ($user) {
                    $follows = Seguidor::where('ID_usuario_seguidor', $user['ID_usuario'])->where('estado', 1)->get();
                    $user['seguidos'] = count($follows);
                    $followers = Seguidor::where('ID_usuario_seguido', $user['ID_usuario'])->where('estado', 1)->get();
                    $user['seguidores'] = count($followers);
                } else {
                    $response['msg'] = "Usuario no encontrado";
                    $response['code'] = 404;
                }
            }
        } else {
            $user = [];
            $response['msg'] = "ID invalida o no proporcionada";
            $response['code'] = 404;
        }

        if ($user) return response()->json($user);
        else return response()->json($response);
    }

    function post($id)
    {
        $response = ['status' => 0, 'msg' => ''];

        if ($id) {
            if (!is_numeric($id)) {
                $recipes = [];
                $response['msg'] = "ID invalida o no proporcionada";
                $response['code'] = 400;
            } else {
                $recipes = [];
                $post = Publicacion::where("ID_publicacion", $id)->first();
                if ($post) {
                    $countLikes = Like::where('ID_publicacion', $post['ID_publicacion'])
                        ->count();
                    $recipes = [
                        'ID_publicacion' => $post['ID_publicacion'],
                        'ID_usuario' => $post['ID_usuario'],
                        'titulo' => $post['titulo'],
                        'descripcion' => $post['descripcion'],
                        'pasos' => [],
                        'ingredientes' => [],
                        'imagen' => $post['imagen'],
                        'duracion' => $post['duracion'],
                        'dificultad' => $post['dificultad'],
                        'likes' => $countLikes
                    ];
                    $steps = Paso::where('ID_publicacion', $post['ID_publicacion'])->get();
                    $pasos = [];
                    foreach ($steps as $step) {
                        $object = [
                            'ID_paso' => $step['ID_paso'],
                            'orden' => $step['orden'],
                            'texto' => $step['texto'],
                        ];
                        $pasos[] = $object;
                    }
                    $recipes['pasos'] = $pasos;

                    $ingredients = PubliIngre::where('ID_publicacion', $post['ID_publicacion'])->get();
                    $ingredientes = [];
                    foreach ($ingredients as $ingredient) {
                        $ingredientecomp = Ingrediente::where('ID_ingrediente', $ingredient['ID_ingrediente'])->first();
                        if ($ingredient['unidad'] == 'x') {
                            $object = [
                                'nombre' => $ingredientecomp['nombre'],
                                'unidad' => $ingredientecomp['nombre'],
                                'cantidad' => $ingredient['cantidad'],
                            ];
                        } else {
                            $object = [
                                'nombre' => $ingredientecomp['nombre'],
                                'unidad' => $ingredient['unidad'],
                                'cantidad' => $ingredient['cantidad'],
                            ];
                        }

                        $ingredientes[] = $object;
                    };
                    $recipes['ingredientes'] = $ingredientes;
                } else {
                    $response['msg'] = "Publicacion no encontrada";
                    $response['code'] = 404;
                }
            }
        }
        if ($recipes) return response()->json($recipes);
        else return response()->json($response);
    }


    public function ingredients(Request $request)
    {
        $response = [
            'status' => 0,
            'msg' => "",
        ];
        $ingredients = Ingrediente::orderBy('nombre')->get();
        if ($ingredients) return response()->json($ingredients);
        return response()->json($response);
    }

    public function postByUser(Request $request)
    {
        $response = [
            'status' => 0,
            'msg' => "",
        ];
        $recipes = [];
        if ($request->has('id') && is_numeric($request['id'])) {

            $posts = Publicacion::where('ID_usuario', $request['id'])->get();
            foreach ($posts as $post) {
                $countLikes = Like::where('ID_publicacion', $post['ID_publicacion'])
                    ->count();
                $recipe = [
                    'ID_publicacion' => $post['ID_publicacion'],
                    'ID_usuario' => $post['ID_usuario'],
                    'titulo' => $post['titulo'],
                    'descripcion' => $post['descripcion'],
                    'pasos' => [],
                    'ingredientes' => [],
                    'imagen' => $post['imagen'],
                    'duracion' => $post['duracion'],
                    'dificultad' => $post['dificultad'],
                    'comentarios' => [],
                    'likes' => $countLikes

                ];
                $steps = Paso::where('ID_publicacion', $post['ID_publicacion'])->get();
                $pasos = [];
                foreach ($steps as $step) {
                    $object = [
                        'ID_paso' => $step['ID_paso'],
                        'orden' => $step['orden'],
                        'texto' => $step['texto'],
                    ];
                    $pasos[] = $object;
                }
                $recipe['pasos'] = $pasos;

                $ingredients = PubliIngre::where('ID_publicacion', $post['ID_publicacion'])->get();
                $ingredientes = [];
                foreach ($ingredients as $ingredient) {
                    $ingredientecomp = Ingrediente::where('ID_ingrediente', $ingredient['ID_ingrediente'])->first();
                    if ($ingredient['unidad'] == 'x') {
                        $object = [
                            'nombre' => $ingredientecomp['nombre'],
                            'unidad' => $ingredientecomp['nombre'],
                            'cantidad' => $ingredient['cantidad'],
                        ];
                    } else {
                        $object = [
                            'nombre' => $ingredientecomp['nombre'],
                            'unidad' => $ingredient['unidad'],
                            'cantidad' => $ingredient['cantidad'],
                        ];
                    }

                    $ingredientes[] = $object;
                };
                $comments = Comentario::where('ID_publicacion', $post['ID_publicacion'])->get();
                $commentsformated = [];
                foreach ($comments as $comment) {
                    $user = Usuario::where('ID_usuario', $comment['ID_usuario'])->first();
                    $object = [
                        'username' => $user['nombre'],
                        'profile_img' => $user['imagen'],
                        'texto' => $comment['texto'],
                    ];
                    $commentsformated[] = $object;
                }
                $recipe['comentarios'] = $commentsformated;
                $recipe['ingredientes'] = $ingredientes;
                $recipes[] = $recipe;
            }
        } else {
            $response['msg'] = "ID invalida o no proporcionada";
            $response['code'] = 400;
            return response()->json($response);
        }

        if ($recipes) return response()->json($recipes);
        else {
            $response['msg'] = "Not found";
            $response['code'] = 404;
            return response()->json($response);
        }
    }

    public function notifications(Request $request)
    {
        $response = [
            'status' => 0,
            'msg' => "",
        ];

        $notificaciones = Notificacion::orderByDesc('fecha')->get();

        $notificacionesConUsuarios = [];

        foreach ($notificaciones as $notificacion) {
            $usuario = Usuario::find($notificacion->ID_usuario);
            $emisor = null;

            if ($notificacion->emisor !== null) {
                $emisor = Usuario::find($notificacion->emisor);
            }

            $notificacionConUsuario = [
                'ID_notificacion' => $notificacion->ID_notificacion,
                'ID_usuario' => $notificacion->ID_usuario,
                'username' => $usuario->nombre,
                'emisor' => $notificacion->emisor,
                'username_emisor' => $emisor ? $emisor->nombre : null,
                'objetivo_post' => $notificacion->objetivo_post,
                'fecha' => $notificacion->fecha,
                'tipo' => $notificacion->tipo,
                'visible' => $notificacion->visible,
            ];

            $notificacionesConUsuarios[] = $notificacionConUsuario;
        }

        if (!empty($notificacionesConUsuarios)) {
            return response()->json($notificacionesConUsuarios);
        }

        return response()->json($response);
    }

    public function notificationsByUser(Request $request)
    {
        $response = [
            'status' => 0,
            'msg' => "",
        ];
        $notifications = [];

        if ($request->has('id') && is_numeric($request['id'])) {
            $userID = $request['id'];
            $visibleNotifications = DB::table('NOTIFICACION')->where('ID_usuario', $userID)
                ->where('visible', 1)->get();

            foreach ($visibleNotifications as $notification) {
                $notificationData = [
                    'ID_notificacion' => $notification->ID_notificacion,
                    'ID_usuario' => $notification->ID_usuario,
                    'emisor' => $notification->emisor,
                    'objetivo_post' => $notification->objetivo_post,
                    'fecha' => $notification->fecha,
                    'tipo' => $notification->tipo,
                    'visible' => $notification->visible
                ];

                $notifications[] = $notificationData;
            }

            if ($notifications) {
                return response()->json($notifications);
            } else {
                $response['msg'] = "No notifications found";
                $response['code'] = 404;
                return response()->json($response);
            }
        } else {
            $response['msg'] = "Invalid or missing ID";
            $response['code'] = 400;
            return response()->json($response);
        }
    }

    public function follows(Request $request)
    {
        $response = [
            'status' => 0,
            'msg' => "",
        ];

        if ($request->has('id') && is_numeric($request['id'])) {
            $userID = $request['id'];

            // Obtener los usuarios seguidos por la persona con la ID proporcionada
            $followedUsers = DB::table('SEGUIDOR')
                ->join('USUARIO', 'SEGUIDOR.ID_usuario_seguido', '=', 'USUARIO.ID_usuario')
                ->where('SEGUIDOR.ID_usuario_seguidor', $userID)
                ->select('USUARIO.*')
                ->get();

            if ($followedUsers) {
                return response()->json($followedUsers);
            } else {
                $response['msg'] = "No se encontraron usuarios seguidos";
                $response['code'] = 404;
            }
        } else {
            $response['msg'] = "Parámetros inválidos";
            $response['code'] = 400;
        }

        return response()->json($response);
    }



    public function followers(Request $request)
    {
        $response = [
            'status' => 0,
            'msg' => "",
        ];

        if ($request->has('id') && is_numeric($request['id'])) {
            $userID = $request['id'];

            // Obtener los usuarios que siguen a la persona con la ID proporcionada
            $followers = DB::table('SEGUIDOR')
                ->join('USUARIO', 'SEGUIDOR.ID_usuario_seguidor', '=', 'USUARIO.ID_usuario')
                ->where('SEGUIDOR.ID_usuario_seguido', $userID)
                ->select('USUARIO.*')
                ->get();

            if ($followers) {
                return response()->json($followers);
            } else {
                $response['msg'] = "No se encontraron seguidores";
                $response['code'] = 404;
            }
        } else {
            $response['msg'] = "Parámetros inválidos";
            $response['code'] = 400;
        }

        return response()->json($response);
    }


    public function is_follow(Request $request)
    {
        $response = [
            'status' => 0,
            'msg' => "",
        ];
        if ($request->has('ID_usuario_seguidor') && $request->has('ID_usuario_seguido')) {
            if (is_numeric($request['ID_usuario_seguidor']) && is_numeric($request['ID_usuario_seguido'])) {

                $follow = Seguidor::where('ID_usuario_seguidor', $request['ID_usuario_seguidor'])
                    ->where('ID_usuario_seguido', $request['ID_usuario_seguido'])
                    ->first();

                if ($follow) {
                    $response['status'] = 1;
                    $response['msg'] = "Ok";
                    $response['code'] = 200;
                    return response()->json($response);
                } else {
                    $response['msg'] = "Not found";
                    $response['code'] = 404;
                }
            } else {
                $response['msg'] = "Invalid parameters";
                $response['code'] = 400;
            }
        } else {
            $response['msg'] = "Invalid parameters";
            $response['code'] = 400;
        }
        return response()->json($response);
    }

    public function has_liked(Request $request)
    {
        $response = [
            'status' => 0,
            'msg' => "",
        ];

        if ($request->has('ID_usuario') && $request->has('ID_publicacion')) {
            if (is_numeric($request['ID_usuario']) && is_numeric($request['ID_publicacion'])) {

                $like = Like::where('ID_usuario', $request['ID_usuario'])
                    ->where('ID_publicacion', $request['ID_publicacion'])
                    ->first();

                if ($like) {
                    $response['status'] = 1;
                    $response['msg'] = "Ok";
                    $response['code'] = 200;
                    return response()->json($response);
                } else {
                    $response['msg'] = "Not found";
                    $response['code'] = 404;
                }
            } else {
                $response['msg'] = "Invalid parameters";
                $response['code'] = 400;
            }
        } else {
            $response['msg'] = "Invalid parameters";
            $response['code'] = 400;
        }

        return response()->json($response);
    }


    public function followsPosts(Request $request)
    {

        $response = [
            'status' => 0,
            'msg' => "",
        ];
        $recipes = [];
        if ($request->has('id') && is_numeric($request['id'])) {

            $posts = DB::table('PUBLICACION AS P')
                ->join('SEGUIDOR AS S', 'P.ID_usuario', '=', 'S.ID_usuario_seguido')
                ->where('S.ID_usuario_seguidor', $request['id'])
                ->select('P.*')
                ->get();

            foreach ($posts as $post) {
                $countLikes = Like::where('ID_publicacion', $post->ID_publicacion)
                    ->count();
                $recipe = [
                    'ID_publicacion' => $post->ID_publicacion,
                    'ID_usuario' => $post->ID_usuario,
                    'titulo' => $post->titulo,
                    'descripcion' => $post->descripcion,
                    'pasos' => [],
                    'ingredientes' => [],
                    'imagen' => $post->imagen,
                    'duracion' => $post->duracion,
                    'dificultad' => $post->dificultad,
                    'comentarios' => [],
                    'likes' => $countLikes

                ];
                $steps = Paso::where('ID_publicacion', $post->ID_publicacion)->get();
                $pasos = [];
                foreach ($steps as $step) {
                    $object = [
                        'ID_paso' => $step['ID_paso'],
                        'orden' => $step['orden'],
                        'texto' => $step['texto'],
                    ];
                    $pasos[] = $object;
                }
                $recipe['pasos'] = $pasos;

                $ingredients = PubliIngre::where('ID_publicacion', $post->ID_publicacion)->get();
                $ingredientes = [];
                foreach ($ingredients as $ingredient) {
                    $ingredientecomp = Ingrediente::where('ID_ingrediente', $ingredient['ID_ingrediente'])->first();
                    if ($ingredient['unidad'] == 'x') {
                        $object = [
                            'nombre' => $ingredientecomp['nombre'],
                            'unidad' => $ingredientecomp['nombre'],
                            'cantidad' => $ingredient['cantidad'],
                        ];
                    } else {
                        $object = [
                            'nombre' => $ingredientecomp['nombre'],
                            'unidad' => $ingredient['unidad'],
                            'cantidad' => $ingredient['cantidad'],
                        ];
                    }

                    $ingredientes[] = $object;
                };
                $comments = Comentario::where('ID_publicacion', $post->ID_publicacion)->get();
                $commentsformated = [];
                foreach ($comments as $comment) {
                    $user = Usuario::where('ID_usuario', $comment['ID_usuario'])->first();
                    $object = [
                        'username' => $user['nombre'],
                        'profile_img' => $user['imagen'],
                        'texto' => $comment['texto'],
                    ];
                    $commentsformated[] = $object;
                }
                $recipe['comentarios'] = $commentsformated;
                $recipe['ingredientes'] = $ingredientes;
                $recipes[] = $recipe;
            }
        } else {
            $response['msg'] = "ID invalida o no proporcionada";
            $response['code'] = 400;
            return response()->json($response);
        }

        if ($recipes) return response()->json($recipes);
        else {
            $response['msg'] = "Not found";
            $response['code'] = 404;
            return response()->json($response);
        }
    }

    public function recipeWithIngredients(Request $request)
    {
        if ($request->has('ingredients') && $request['ingredients'] != null && $request['ingredients'] != '') {
            if (!is_numeric($request['ingredients']) || !is_string($request['ingredients'])) {

                $selectedIngredients = json_decode($request['ingredients'], true);
                $ingredientCount = count($selectedIngredients);

                $recipes = DB::table('PUBLICACION')
                    ->join('PUBLICACION_INGREDIENTE', 'PUBLICACION.ID_publicacion', '=', 'PUBLICACION_INGREDIENTE.ID_publicacion')
                    ->whereIn('PUBLICACION_INGREDIENTE.ID_ingrediente', $selectedIngredients)
                    ->groupBy('PUBLICACION.ID_publicacion', 'PUBLICACION.titulo', 'PUBLICACION.descripcion', 'PUBLICACION.imagen', 'PUBLICACION.duracion', 'PUBLICACION.dificultad')
                    ->havingRaw('COUNT(DISTINCT PUBLICACION_INGREDIENTE.ID_ingrediente) = ?', [$ingredientCount])
                    ->select('PUBLICACION.ID_publicacion', 'PUBLICACION.ID_usuario', 'PUBLICACION.titulo', 'PUBLICACION.descripcion', 'PUBLICACION.imagen', 'PUBLICACION.duracion', 'PUBLICACION.dificultad')
                    ->get();

                $response = ['status' => 0, 'msg' => 'Publicaciones no encontradas'];
                $response['code'] = 404;
                $result = [];

                foreach ($recipes as $recipe) {
                    $countLikes = Like::where('ID_publicacion', $recipe->ID_publicacion)
                        ->count();
                    $recipeDetails = [
                        'ID_publicacion' => $recipe->ID_publicacion,
                        'ID_usuario' => $recipe->ID_usuario,
                        'titulo' => $recipe->titulo,
                        'descripcion' => $recipe->descripcion,
                        'pasos' => [],
                        'ingredientes' => [],
                        'imagen' => $recipe->imagen,
                        'duracion' => $recipe->duracion,
                        'dificultad' => $recipe->dificultad,
                        'comentarios' => [],
                        'likes' => $countLikes
                    ];

                    $steps = Paso::where('ID_publicacion', $recipe->ID_publicacion)->get();
                    $pasos = [];
                    foreach ($steps as $step) {
                        $object = [
                            'ID_paso' => $step->ID_paso,
                            'orden' => $step->orden,
                            'texto' => $step->texto,
                        ];
                        $pasos[] = $object;
                    }
                    $recipeDetails['pasos'] = $pasos;

                    $ingredients = PubliIngre::where('ID_publicacion', $recipe->ID_publicacion)->get();
                    $ingredientes = [];
                    foreach ($ingredients as $ingredient) {
                        $ingredientecomp = Ingrediente::where('ID_ingrediente', $ingredient->ID_ingrediente)->first();
                        if ($ingredient->unidad == 'x') {
                            $object = [
                                'nombre' => $ingredientecomp->nombre,
                                'unidad' => $ingredientecomp->nombre,
                                'cantidad' => $ingredient->cantidad,
                            ];
                        } else {
                            $object = [
                                'nombre' => $ingredientecomp->nombre,
                                'unidad' => $ingredient->unidad,
                                'cantidad' => $ingredient->cantidad,
                            ];
                        }

                        $ingredientes[] = $object;
                    }

                    $comments = Comentario::where('ID_publicacion', $recipe->ID_publicacion)->get();
                    $commentsformated = [];
                    foreach ($comments as $comment) {
                        $user = Usuario::where('ID_usuario', $comment->ID_usuario)->first();
                        $object = [
                            'username' => $user->nombre,
                            'profile_img' => $user->imagen,
                            'texto' => $comment->texto,
                        ];
                        $commentsformated[] = $object;
                    }

                    $recipeDetails['comentarios'] = $commentsformated;
                    $recipeDetails['ingredientes'] = $ingredientes;
                    $result[] = $recipeDetails;
                }

                if ($result) {
                    return response()->json($result);
                } else {
                    $response['msg'] = 'No se encontraron recetas';
                    $response['code'] = 404;
                    return response()->json($response);
                }
            } else {
                $response['msg'] = 'Invalid Parameters';
                $response['code'] = 400;
                return response()->json($response);
            }
        } else {
            $response['msg'] = 'Invalid Parameters';
            $response['code'] = 400;
            return response()->json($response);
        }
    }
}
