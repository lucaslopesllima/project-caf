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

    public function perguntas()
    {
        return $this->belongsTo(Pergunta::class);
    }

    public static function getWholeQuetionFromQuestionnaire($questionarioId)
    {
        return self::where('questionario_id', $questionarioId)
            ->join('perguntas', 'pergunta_questionarios.pergunta_id', '=', 'perguntas.id')
            ->select('perguntas.*')
            ->orderBy('perguntas.id', 'desc')
            ->get();
    }
}
