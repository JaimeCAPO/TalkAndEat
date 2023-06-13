<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/users',[ApiController::class, 'users']); //obtener usuarios
Route::get('/posts',[ApiController::class, 'posts']); //obtener publicaciones
Route::get('/8posts',[ApiController::class, 'Eightposts']); //obtener publicaciones

Route::get('/postsBy',[ApiController::class, 'postByUser']); //publicaciones de x
Route::get('/followsPosts',[ApiController::class, 'followsPosts']); //obtener publicaciones de gente que sigue x persona


Route::get('/users/{id}',[ApiController::class, 'user']); //obtener usuario
Route::get('/posts/{id}',[ApiController::class, 'post']); //obtener publicacion
Route::get('/postswith',[ApiController::class, 'GetPostsByKeyword']);//obtener publicaciones con titulos que contengan x
Route::get('/userswith',[ApiController::class, 'GetUsersByUsername']);//obtener usuarios con nombres que contengan x
Route::get('/recipesIngredients',[ApiController::class,'recipeWithIngredients']); //obtener recetas con x ingredientes.
Route::get('/ingredients',[ApiController::class, 'ingredients']); //todos los ingredientes

Route::get('/isfollow',[ApiController::class,'is_follow']); //le sigues? 
Route::get('follows',[ApiController::class,'follows']); //obtener seguidos
Route::get('followers',[ApiController::class,'followers']); //obtener seguidores

Route::get('/islike',[ApiController::class,'has_liked']); //devuelve 200 si el usuario le dio like a la publicacion
Route::get('/notifications',[ApiController::class, 'notifications']); //todas las notificaciones
Route::get('/notificationsBy',[ApiController::class, 'notificationsByUser']); //todas las notificaciones visibles de un usuario


Route::post('/follow',[ApiPostController::class,'addFollow']); //añadir seguimiento 
Route::post('/like',[ApiPostController::class,'addLike']); //añadir like 
Route::post('/post',[ApiPostController::class,'addPost']); //añadir publicacion 
Route::post('/comment',[ApiPostController::class,'addComment']); //añadir publicacion 
Route::delete('/deletePost',[ApiPostController::class,'deletePost']); //eliminar publicacion
Route::delete('/deleteUser',[ApiPostController::class,'deleteUser']); //eliminar usuario 
Route::delete('/deleteFollow',[ApiPostController::class,'deleteFollow']); //eliminar seguimiento
Route::delete('/deleteLike',[ApiPostController::class,'deleteLike']); //eliminar un like
Route::delete('/allnotifications',[ApiPostController::class,'deleteNotifications']); //borrar todas las notificaciones
Route::put('/user',[ApiPostController::class,'updateUsuario']); //actualizar usuario. 
Route::put('/hidenotification',[ApiPostController::class,'updateNotification']); //actualizar notificacion visible=0