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
        $pessoas = Pessoa::all();
        $questionarios = Questionario::all();

        foreach ($pessoas as $pessoa) {
            $numQuestionarios = rand(1, 3);
            
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