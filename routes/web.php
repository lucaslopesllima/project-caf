<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PerguntaController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionarioController;
use App\Models\Pessoa;
use App\Models\Questionario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('register', [RegisteredUserController::class, 'create'])
->name('register');

Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {

    Route::resources([
        'profile'=>ProfileController::class,
        'pergunta'=>PerguntaController::class,
        'pessoa'=>PessoaController::class,
        'questionario'=>QuestionarioController::class
    ]);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

require __DIR__.'/auth.php';
