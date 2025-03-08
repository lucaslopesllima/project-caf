<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntaQuestionario extends Model
{
    protected $fillable = [
        'questionario_id',
        'pergunta_id'
    ];

    public function questionario()
    {
        return $this->belongsTo(Questionario::class);
    }

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }
}
