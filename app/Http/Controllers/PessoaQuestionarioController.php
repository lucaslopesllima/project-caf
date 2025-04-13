<?php

namespace App\Http\Controllers;

use App\Models\PessoaQuestionario;
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
}
