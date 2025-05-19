<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    public function index()
    {   
        $person = new PessoaController();
        $questionnaire = new QuestionarioController();


        return view('dashboard',
            [
                'quantityPeople'=>$person->getQuantityNotVolunteer(),
                'quantityVolunteer'=> $person->getQuantityVolunteer(),
                'quantityReplies'=> $questionnaire->getHowMuchQuestionnairiesReplied(),
                'quantityPerMonth'=> $person->getEachPeopleRegisteredPerMonth(),
                'lastRegisteredPeople'=> $person->getLastRegisteredPeople()
            ]);
    }   
}
