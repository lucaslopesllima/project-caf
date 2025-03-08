<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaQuestionario extends Model
{
    protected $fillable = [
        'questionario_id',
        'pessoa_id'
    ];

    public function questionario()
    {
        return $this->belongsTo(Questionario::class);
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
