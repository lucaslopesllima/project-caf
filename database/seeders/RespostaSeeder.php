<?php

namespace Database\Seeders;

use App\Models\PerguntaQuestionario;
use App\Models\PessoaQuestionario;
use App\Models\Resposta;
use Illuminate\Database\Seeder;

class RespostaSeeder extends Seeder
{
    public function run(): void
    {
        // Array de possíveis respostas aleatórias
        $respostasAleatorias = [
            'Concordo plenamente',
            'Discordo parcialmente',
            'Neutro sobre o assunto',
            'Muito satisfeito',
            'Precisa melhorar',
            'Excelente iniciativa',
            'Regular',
            'Não tenho opinião formada',
            'Poderia ser melhor',
            'Superou as expectativas'
        ];

        // Obtém todas as relações pessoa-questionário
        $pessoaQuestionarios = PessoaQuestionario::all();

        foreach ($pessoaQuestionarios as $pessoaQuestionario) {
            // Obtém todas as perguntas do questionário atual
            $perguntas = PerguntaQuestionario::where('questionario_id', $pessoaQuestionario->questionario_id)->get();

            // Para cada pergunta do questionário, cria uma resposta
            foreach ($perguntas as $pergunta) {
                Resposta::create([
                    'pessoa_id' => $pessoaQuestionario->pessoa_id,
                    'pergunta_id' => $pergunta->id,
                    'questionario_id' => $pessoaQuestionario->questionario_id,
                    'texto' => $respostasAleatorias[array_rand($respostasAleatorias)]
                ]);
            }
        }
    }
}