<?php

namespace App\Http\Controllers;

use App\Models\PessoaQuestionario;
use App\Models\PerguntaQuestionario;
use App\Models\Resposta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PessoaQuestionarioController extends Controller
{
   
    public function index()
    {
        $answers = PessoaQuestionario::with(
            ['pessoa', 'questionario']
            ) ->select('pessoa_questionarios.id', 'pessoa_id',
             'questionario_id','pessoa_questionarios.created_at',
             'pessoa_questionarios.updated_at', 'pessoas.nome AS person_name',
             'questionarios.nome AS questionnaire_name'
             )->join('pessoas', 'pessoa_id', 'pessoas.id')
              ->join('questionarios', 'questionario_id', 'questionarios.id')
              ->orderBy('id','desc')
              ->paginate(getenv('PER_PAGE'));

        return view('reponseQuestionnaires.index',['answers'=>$answers]);
    }

    public function getAllQuestinnairesAnswered()
    {
        $respostas = PessoaQuestionario::with(['pessoa', 'questionario'])->get();
        return response()->json($respostas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pessoa_id' => 'required|exists:pessoas,id',
            'questionario_id' => 'required|exists:questionarios,id',
            'respostas' => 'required|array'
        ]);

        $pessoaQuestionario = PessoaQuestionario::create([
            'pessoa_id' => $request->pessoa_id,
            'questionario_id' => $request->questionario_id,
        ]);

        return response()->json($pessoaQuestionario, Response::HTTP_CREATED);
    }

    public function questionariosPorPessoa($pessoa_id)
    {
        $questionarios = PessoaQuestionario::where('pessoa_id', $pessoa_id)
            ->with('questionario')
            ->get();
        
        return response()->json($questionarios);
    }

    public function pessoasPorQuestionario($questionario_id)
    {
        $pessoas = PessoaQuestionario::where('questionario_id', $questionario_id)
            ->with('pessoa')
            ->get();
        
        return response()->json($pessoas);
    }

    public function destroy($id)
    {
        $pessoaQuestionario = PessoaQuestionario::findOrFail($id);
        $pessoaQuestionario->delete();
        
        return redirect()->route('solved_questionnairies')->with('success', 'Registro deletado com sucesso!');
    }

    public function edit($id)
    {
        $pessoaQuestionario = PessoaQuestionario::with(['pessoa', 'questionario'])
            ->findOrFail($id);

        $perguntas = PerguntaQuestionario::getWholeQuetionFromQuestionnaire($pessoaQuestionario->questionario_id);
        
        $respostas = Resposta::where([
            'pessoa_id' => $pessoaQuestionario->pessoa_id,
            'questionario_id' => $pessoaQuestionario->questionario_id
        ])->get();

        $respostasMap = [];
        foreach ($respostas as $resposta) {
            $respostasMap[$resposta->pergunta_id] = $resposta;
        }

        return view('reponseQuestionnaires.edit', [
            'pessoaQuestionario' => $pessoaQuestionario,
            'perguntas' => $perguntas,
            'respostas' => $respostasMap
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'respostas' => 'required|array'
        ]);

        $pessoaQuestionario = PessoaQuestionario::findOrFail($id);

        foreach ($request->respostas as $perguntaId => $texto) {
            Resposta::updateOrCreate(
                [
                    'pessoa_id' => $pessoaQuestionario->pessoa_id,
                    'questionario_id' => $pessoaQuestionario->questionario_id,
                    'pergunta_id' => $perguntaId
                ],
                ['texto' => $texto]
            );
        }

        return redirect()->route('solved_questionnairies')
            ->with('success', 'Respostas atualizadas com sucesso!');
    }

    public function getAnswersData($id)
    {
        $pessoaQuestionario = PessoaQuestionario::with(['pessoa', 'questionario'])
            ->findOrFail($id);

        $perguntas = PerguntaQuestionario::getWholeQuetionFromQuestionnaire($pessoaQuestionario->questionario_id);
        
        $respostas = Resposta::where([
            'pessoa_id' => $pessoaQuestionario->pessoa_id,
            'questionario_id' => $pessoaQuestionario->questionario_id
        ])->get();

        $questionsAndAnswers = $perguntas->map(function($pergunta) use ($respostas) {
            $resposta = $respostas->firstWhere('pergunta_id', $pergunta->id);
            return [
                'pergunta' => $pergunta->texto,
                'resposta' => $resposta ? $resposta->texto : null
            ];
        });

        return response()->json([
            'pessoa' => [
                'nome' => $pessoaQuestionario->pessoa->nome,
            ],
            'questionario' => [
                'nome' => $pessoaQuestionario->questionario->nome,
            ],
            'questoes_respostas' => $questionsAndAnswers
        ]);
    }
}
