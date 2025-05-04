<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PerguntaController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\PessoaQuestionarioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionarioController;
use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    
    Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::resources([
        'profile'             => ProfileController::class,
        'pergunta'            => PerguntaController::class,
        'pessoa'              => PessoaController::class,
        'questionario'        => QuestionarioController::class,
        'pessoa-questionario' => PessoaQuestionarioController::class,
    ]);

    Route::get('/fila',[QueueController::class, 'index'])->name('queue.index');
    Route::post('/marcar-atendido',[QueueController::class, 'setAttendedStatus'])->name('queue.setAttended');
    Route::post('/atualizar-prioridade',[QueueController::class, 'setPriority'])->name('queue.setPriority');

    Route::get('responder-questionario',
    [PessoaQuestionarioController::class,'index'])
    ->name('solved_questionnairies');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    Route::get('pessoa-questionario/{id}/answers-data', 
        [PessoaQuestionarioController::class, 'getAnswersData'])
        ->name('pessoa-questionario.answers-data');


    Route::get('getWholeQuestions/{id}', 
         [
             QuestionarioController::class,
            'getWholeQuestions'
         ])
        ->name('questionario.getWholeQuestions');

});

require __DIR__.'/auth.php';
