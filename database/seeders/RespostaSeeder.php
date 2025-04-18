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
            'Superou as expectativas',
            'Não vejo problema nisso',
            'Acho que pode funcionar',
            'É uma boa ideia',
            'Tenho minhas dúvidas',
            'Não concordo',
            'Totalmente fora do esperado',
            'Fiquei impressionado',
            'Precisa de mais análise',
            'Apoio essa decisão',
            'Pode causar confusão',
            'Gostei bastante',
            'Achei razoável',
            'Não fez sentido pra mim',
            'É controverso',
            'Sem comentários',
            'Vale a tentativa',
            'Tem potencial',
            'Requer ajustes',
            'Incrível!',
            'Foi uma decepção',
            'Nada mal',
            'Parece promissor',
            'Prefiro não opinar',
            'Isso é preocupante',
            'A ideia é válida',
            'Foi útil até certo ponto',
            'Não atingiu minhas expectativas',
            'Sinto que falta algo',
            'É um começo',
            'Tem margem para melhoria',
            'Curioso, mas incompleto',
            'Bem estruturado',
            'Faltou clareza',
            'Me surpreendeu positivamente',
            'Pode confundir algumas pessoas',
            'Achei genial',
            'Precisa de revisão',
            'Não me convenceu',
            'Ficou acima da média',
            'Me deixou indeciso'
        ];
        

        $pessoaQuestionarios = PessoaQuestionario::all();

        foreach ($pessoaQuestionarios as $pessoaQuestionario) {
            $perguntas = PerguntaQuestionario::where('questionario_id', $pessoaQuestionario->questionario_id)->get();

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