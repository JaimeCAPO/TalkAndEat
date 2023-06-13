<?php
namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model

{

    use HasFactory;

    protected $table = 'USUARIO';

    protected $primaryKey = 'ID_usuario';

    protected $fillable = [
        'nombre',
        'contrasena',
        'correo_electronico',
        'biografia',
        'foto_perfil',
    ];
    
    public $timestamps=false;
}
