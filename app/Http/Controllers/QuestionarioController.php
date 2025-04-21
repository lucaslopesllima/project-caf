<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use App\Models\PerguntaQuestionario;
use Illuminate\Http\Request;
use App\Models\Questionario;
use App\Service\QuestionnaireService;

class QuestionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Questionario::orderBy('id','desc');

        $filters = $request->all();

        if(isset($filters["nameQuestionnaire"])){
            $query->where('nome','like','%'.$filters["nameQuestionnaire"].'%');
        } 

        $questionnaires = $query->paginate(10);

        return view('questionnaire.index', compact('questionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Pergunta::orderBy('id', 'desc')
        ->get();
        
        return view('questionnaire.create'
        , compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_questionnaire' => 'required',
            'questions'          => 'required',
        ]);

        QuestionnaireService::createQuestinnaire();

        return redirect()->route('questionario.index')
            ->with('success', 'Questionário criado com sucesso.');
    }

  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Questionario $questionario){

        $questions_from_questionnaire =
         PerguntaQuestionario::
        getWholeQuestionFromQuestionnaire($questionario->id);

        $questionnaire_id = $questionario->id;
        $questions = Pergunta::orderBy('id', 'desc')->get();
        $name_questionnrie = $questionario->nome;
        
        return view('questionnaire.edit', 
                        compact('questions_from_questionnaire',
                                'questions','name_questionnrie',
                                'questionnaire_id'));
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

        QuestionnaireService::updateQuestinnaire();

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

    public function getWholeQuestions($id)
    {
        $questions = PerguntaQuestionario::getWholeQuestionFromQuestionnaire($id);

        return response()->json([
                'questions' => $questions
        ]);
    }
}
