<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerguntaQuestionario;
use App\Models\Questionario;
use App\Models\Pergunta;

class PerguntaQuestionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Busca todos os questionários e perguntas disponíveis
        $questionarios = Questionario::all();
        $perguntas = Pergunta::all();

        // Verifica se existem questionários e perguntas
        if ($questionarios->isEmpty() || $perguntas->isEmpty()) {
            return;
        }

        // Limpa registros existentes para evitar duplicatas
        PerguntaQuestionario::truncate();

        // Para cada questionário, associa algumas perguntas
        foreach ($questionarios as $questionario) {
            // Embaralha as perguntas para cada questionário
            $perguntasEmbaralhadas = $perguntas->shuffle();
            
            // Define um número aleatório de perguntas para este questionário
            // dividindo a quantidade de perguntas pelo quantidade de questionarios
            $quantidadePerguntas = intdiv($perguntas->count(),$questionarios->count());

            // Pega apenas a quantidade definida de perguntas
            $perguntasSelecionadas = $perguntasEmbaralhadas->take($quantidadePerguntas);

            // Cria os registros de PerguntaQuestionario
            foreach ($perguntasSelecionadas as $pergunta) {
                PerguntaQuestionario::create([
                    'questionario_id' => $questionario->id,
                    'pergunta_id' => $pergunta->id,
                ]);
            }
        }
    }
}
