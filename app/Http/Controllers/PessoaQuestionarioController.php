<?php

namespace App\Http\Controllers;

use App\Models\PessoaQuestionario;
use App\Models\PerguntaQuestionario;
use App\Models\Pessoa;
use App\Models\Questionario;
use App\Models\Resposta;
use Exception;
use Illuminate\Http\Request;

class PessoaQuestionarioController extends Controller
{
   
    public function index(Request $request)
    {   

        $filters = $request->all();
        
        $query = PessoaQuestionario::with(['pessoa', 'questionario'])
            ->select('pessoa_questionarios.id', 'pessoa_id',
                     'questionario_id','pessoa_questionarios.created_at',
                     'pessoa_questionarios.updated_at', 'pessoas.nome AS person_name',
                     'questionarios.nome AS questionnaire_name')
            ->join('pessoas', 'pessoa_id', 'pessoas.id')
            ->join('questionarios', 'questionario_id', 'questionarios.id')
            ->orderBy('id','desc');
            
            if(isset($filters["ownerName"])){
                $query->where('pessoas.nome','like','%'.$filters["ownerName"].'%');
            } 
    
            if(isset($filters["nameQuetionnaire"])){
    
                $query->where('questionarios.nome','like','%'.$filters["nameQuetionnaire"].'%');   
            }
    
            $answers = $query->paginate(10);

        return view('reponseQuestionnaires.index',[
            'answers' => $answers,
            'filters' => $filters
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'personId' => 'required|exists:pessoas,id',
            'questionnaireId' => 'required|exists:questionarios,id',
        ]);

        $personId = $request->input('personId');
        $questionnaireId = $request->input('questionnaireId');
        
        $allData = $request->all();
        $dataPrepared = [];

        foreach ($allData as $key => $value) {
            if (str_starts_with($key, 'resposta_')) {

                $questionId = str_replace('resposta_', '', $key);

                array_push($dataPrepared,
                [
                    'pessoa_id'=>$personId,
                    'questionario_id'=>$questionnaireId,
                    'pergunta_id'=>$questionId,
                    'texto'=>$value,
                    'created_at'=>date('Y-m-d H:s:i'),
                    'updated_at'=>date('Y-m-d H:s:i')
                ]);
            }
        }
        
        try {
            
            Resposta::insert($dataPrepared);
            PessoaQuestionario::insert(
                [
                    'pessoa_id'=>$personId,
                    'questionario_id'=>$questionnaireId,
                    'created_at'=>date('Y-m-d H:s:i'),
                    'updated_at'=>date('Y-m-d H:s:i')
                ]
            );
        } catch (Exception $e) {
            
            return redirect()->back()->withErrors("Erro ao salvar as resposta, tente novamente!");
        }


        return redirect()->route('solved_questionnairies')->with('success', 'Resposta salva com sucesso!');
    }

    public function destroy($id)
    {
        $pessoaQuestionario = PessoaQuestionario::findOrFail($id);
        $pessoaQuestionario->delete();
        
        return redirect()->route('solved_questionnairies')->with('success', 'Registro deletado com sucesso!');
    }

    public function create()
    {   
        $people = Pessoa::all();
        $questionnaires = Questionario::all();

        return view('reponseQuestionnaires.create',['people' => $people,
                                                    'questionnaires' => $questionnaires]);
    }

    public function edit($id)
    {
        $pessoaQuestionario = PessoaQuestionario::with(['pessoa', 'questionario'])
            ->findOrFail($id);

        $perguntas = PerguntaQuestionario::getWholeQuestionFromQuestionnaire($pessoaQuestionario->questionario_id);
        
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

        $perguntas = PerguntaQuestionario::getWholeQuestionFromQuestionnaire($pessoaQuestionario->questionario_id);
        
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
