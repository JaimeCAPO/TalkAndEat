<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'CHAT';

    protected $primaryKey = 'ID_chat';

    protected $fillable = [
        'ID_usuario1',
        'ID_usuario2',
    ];
    
    public $timestamps=false;
}
