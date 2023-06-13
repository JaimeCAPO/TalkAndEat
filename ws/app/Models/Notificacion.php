<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'NOTIFICACION';

    protected $primaryKey = 'ID_notificacion';

    protected $fillable = [
        'ID_usuario',
        'emisor',
        'objetivo_post',
        'fecha',
        'tipo',
        'visible',
    ];
    
    public $timestamps=false;
}
