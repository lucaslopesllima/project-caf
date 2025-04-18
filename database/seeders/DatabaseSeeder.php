<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->count(10)->create();
        $this->call(PessoaSeeder::class);
        $this->call(PerguntaSeeder::class);
        $this->call(QuestionarioSeeder::class);
        $this->call(PerguntaQuestionarioSeeder::class);
        $this->call(RespostaSeeder::class);
        $this->call(PessoaQuestionarioSeeder::class);
    }
}
