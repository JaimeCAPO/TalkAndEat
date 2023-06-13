<?php
namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model implements Authenticatable
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
    public function getAuthIdentifierName()
    {
        return $this->primaryKey;
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->primaryKey};
    }

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getRememberToken()
    {
        // No se utiliza en este caso
    }

    public function setRememberToken($value)
    {
        // No se utiliza en este caso
    }

    public function getRememberTokenName()
    {
        // No se utiliza en este caso
    }
}
