<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use App\Models\Questionario;
use App\Models\PessoaQuestionario;
use Illuminate\Database\Seeder;

class PessoaQuestionarioSeeder extends Seeder
{
    public function run(): void
    {
        // Garante que temos pessoas e questionários para relacionar
        $pessoas = Pessoa::all();
        $questionarios = Questionario::all();

        // Para cada pessoa, responde alguns questionários aleatoriamente
        foreach ($pessoas as $pessoa) {
            // Cada pessoa responde entre 1 e 3 questionários
            $numQuestionarios = rand(1, 3);
            
            // Pega questionários aleatórios para esta pessoa
            $questionariosAleatorios = $questionarios->random($numQuestionarios);

            foreach ($questionariosAleatorios as $questionario) {
                PessoaQuestionario::create([
                    'pessoa_id' => $pessoa->id,
                    'questionario_id' => $questionario->id,
                ]);
            }
        }
    }
} 