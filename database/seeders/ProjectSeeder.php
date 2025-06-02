<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        if (Pessoa::count() === 0) {
            \App\Models\Pessoa::factory()->count(10)->create();
        }

        if (User::count() === 0) {
            \App\Models\User::factory()->count(5)->create();
        }

        Project::factory()
            ->count(10)
            ->withPeople(3)       
            ->withVolunteers(2)   
            ->withUsers(2)       
            ->create();
    }
}
