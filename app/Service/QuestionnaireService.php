<?php

namespace App\Service;

use App\Models\PerguntaQuestionario;
use App\Models\Questionario;

class QuestionnaireService{


    public static function updateQuestinnaire(){

        Questionario::where('id', $_POST["questinnaire_id"])
        ->update(['nome' =>$_POST["name_questionnaire"]]);

        PerguntaQuestionario::where('questionario_id',
         $_POST["questinnaire_id"])
        ->delete();

        self::addQuestionsToQuestionnaire();
    }

    public static function createQuestinnaire(){
        $_POST['questinnaire_id'] = Questionario::insertGetId([
            'nome' =>$_POST["name_questionnaire"],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        self::addQuestionsToQuestionnaire();
    }

    private static function addQuestionsToQuestionnaire(){
        $questionsToQuestionnaire = [];
        foreach ($_POST["questions"] as $perguntaId) {
            
            array_push(
                $questionsToQuestionnaire,
                [
                    'questionario_id' => $_POST["questinnaire_id"],
                    'pergunta_id' => $perguntaId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );


        }

        PerguntaQuestionario::insert($questionsToQuestionnaire);
    }   
}