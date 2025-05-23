<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    use HasFactory;

    protected $fillable = [
        'pessoa_id',
        'pergunta_id',
        'questionario_id',
        'texto'
    ];
}
