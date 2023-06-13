<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

    
    function logUser($user){
        setcookie('username',$user['nombre'],86400); //el usuario se mantendrá guardado durante 1 dia
    }
    
    function unlogUser(){
        setcookie('username','',time()-86400); 
    }



