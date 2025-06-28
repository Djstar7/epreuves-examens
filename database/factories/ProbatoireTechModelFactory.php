<?php

namespace Database\Factories;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProbatoireTechModel>
 */
class probatoireTechModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teacheIds = TeacherModel::pluck('id')->toArray();
        return [
            'subject_probatoire_tech' => $this->faker->word(),
            'year_probatoire_tech' => $this->faker->year(),
            'branch_probatoire_tech' => $this->faker->word(),
            'price_probatoire_tech' => $this->faker->randomFloat(2, 10, 100),
            'file_probatoire_tech' => $this->faker->url(),
            // Assuming teacher_id_probatoire_tech is a foreign key referencing the teachers table
            'teacher_id_probatoire_tech' => $this->faker->randomElement($teacheIds),    
        ];
    }
}
