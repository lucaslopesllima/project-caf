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
        $questionarios = Questionario::all();
        $perguntas = Pergunta::all();

        if ($questionarios->isEmpty() || $perguntas->isEmpty()) {
            return;
        }

        PerguntaQuestionario::truncate();

        foreach ($questionarios as $questionario) {
            $perguntasEmbaralhadas = $perguntas->shuffle();
            
            $quantidadePerguntas = intdiv($perguntas->count(),$questionarios->count());

            $perguntasSelecionadas = $perguntasEmbaralhadas->take($quantidadePerguntas);

            foreach ($perguntasSelecionadas as $pergunta) {
                PerguntaQuestionario::create([
                    'questionario_id' => $questionario->id,
                    'pergunta_id' => $pergunta->id,
                ]);
            }
        }
    }
}
