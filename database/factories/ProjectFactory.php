<?php 


namespace Database\Factories;

use App\Models\Pessoa;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $dateStarted = $this->faker->dateTimeBetween('-2 years', 'now');
        $dateFinished = $this->faker->optional()->dateTimeBetween($dateStarted, '+6 months');

        $responsibleModel = null;
        if (Pessoa::exists()) {
            $responsibleModel = Pessoa::inRandomOrder()->first();
        } elseif (User::exists()) {
            $responsibleModel = User::inRandomOrder()->first();
        }

        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'date_started' => $dateStarted,
            'date_finished' => $dateFinished,
            'responsible_id' => $responsibleModel?->id,
            'responsible_type' => $responsibleModel ? get_class($responsibleModel) : null,
            'is_activated' => $this->faker->boolean(80),
        ];
    }

    public function withPeople(int $count = 3): static
    {
        return $this->afterCreating(function (Project $project) use ($count) {
            if (Pessoa::count() > 0) {
                $people = Pessoa::inRandomOrder()->take($count)->get();
                $project->people()->attach($people->pluck('id')->toArray(), [
                    'is_volunteer' => false
                ]);
            }
        });
    }

    public function withVolunteers(int $count = 2): static
    {
        return $this->afterCreating(function (Project $project) use ($count) {
            if (Pessoa::count() > 0) {
                $volunteers = Pessoa::inRandomOrder()->take($count)->get();
                $project->people()->attach($volunteers->pluck('id')->toArray(), [
                    'is_volunteer' => true
                ]);
            }
        });
    }

    public function withUsers(int $count = 2): static
    {
        return $this->afterCreating(function (Project $project) use ($count) {
            if (User::count() > 0) {
                $users = User::inRandomOrder()->take($count)->get();
                $project->users()->attach($users);
            }
        });
    }
}
