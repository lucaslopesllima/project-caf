<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PessoaSeeder extends Seeder
{
  
    public function run(): void
    {
        \App\Models\Pessoa::factory(100)->create();
    }
}
