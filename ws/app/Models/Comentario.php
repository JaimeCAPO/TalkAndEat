<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'COMENTARIO';

    protected $primaryKey = 'ID_comentario';

    protected $fillable = [
        'ID_publicacion',
        'ID_usuario',
        'texto',
    ];
    
    public $timestamps=false;

}
