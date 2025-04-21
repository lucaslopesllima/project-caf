<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerguntaQuestionarioController;
use App\Http\Controllers\PessoaController;

Route::post('/pergunta-questionario/{pergunta_id}/{questionario_id}', [PerguntaQuestionarioController::class, 'store'])
    ->name('pergunta-questionario.store'); 

Route::get('/pergunta-questionario/{id}', [PerguntaQuestionarioController::class, 'store'])
    ->name('pergunta-questionario.destroy'); 


Route::get('pessoas_questionario',[PessoaController::class,'getPeople']);