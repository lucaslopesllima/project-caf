<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerguntaQuestionarioController;


Route::post('/pergunta-questionario/{pergunta_id}/{questionario_id}', [PerguntaQuestionarioController::class, 'store'])
    ->name('pergunta-questionario.store'); 

Route::get('/pergunta-questionario/{id}', [PerguntaQuestionarioController::class, 'store'])
    ->name('pergunta-questionario.destroy'); 