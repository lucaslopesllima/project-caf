<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use App\Models\Pergunta;
use App\Models\Questionario;
use App\Models\PessoaQuestionario;
use App\Models\Resposta;
use Illuminate\Database\Seeder;

class RespostaSeeder extends Seeder
{
    public function run(): void
    {
        // Obtém todas as relações pessoa-questionário
        $pessoaQuestionarios = PessoaQuestionario::all();

        foreach ($pessoaQuestionarios as $pessoaQuestionario) {
            // Obtém todas as perguntas do questionário atual
            $perguntas = Pergunta::where('questionario_id', $pessoaQuestionario->questionario_id)->get();

            // Para cada pergunta do questionário, cria uma resposta
            foreach ($perguntas as $pergunta) {
                Resposta::create([
                    'pessoa_id' => $pessoaQuestionario->pessoa_id,
                    'pergunta_id' => $pergunta->id,
                    'questionario_id' => $pessoaQuestionario->questionario_id,
                ]);
            }
        }
    }
} 