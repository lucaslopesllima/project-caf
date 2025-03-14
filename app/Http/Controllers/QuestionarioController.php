<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use App\Models\PerguntaQuestionario;
use Illuminate\Http\Request;
use App\Models\Questionario;
use App\Models\Pessoa;

class QuestionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionnaires = Questionario::orderBy('id','desc')->paginate(env('PER_PAGE'));
        return view('questionnaire.index', compact('questionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Pergunta::orderBy('id', 'desc')->get();
        return view('questionnaire.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pergunta' => 'required',
            'resposta' => 'required',
            'pessoa_id' => 'required|exists:pessoas,id'
        ]);

        Questionario::create($request->all());
        return redirect()->route('questionnaire.index')
            ->with('success', 'Questionário criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Questionario $questionario)
    {
        return view('questionnaire.show', compact('questionario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Questionario $questionario){

        $questions_from_questionnaire = PerguntaQuestionario::getWholeQuetionFromQuestionnaire($questionario->id);
        $questions = Pergunta::orderBy('id', 'desc')->get();
        $name_questionnrie = $questionario->nome;
        
        return view('questionnaire.edit', compact('questions_from_questionnaire', 'questions','name_questionnrie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name_questionnaire' => 'required',
            'questions'          => 'required',
        ]);

        Questionario::where('id', $request->id)->update(['nome' => $request->name_questionnaire]);

        return redirect()->route('questionario.index')
            ->with('success', 'Questionário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Questionario $questionario)
    {
        $questionario->delete();
        return redirect()->route('questionario.index')
            ->with('success', 'Questionário excluído com sucesso.');
    }
}
