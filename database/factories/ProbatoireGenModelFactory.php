<?php

namespace Database\Factories;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProbatoireGenModel>
 */
class probatoireGenModelFactory extends Factory
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
            'subject_probatoire_gen' => $this->faker->word(),
            'year_probatoire_gen' => $this->faker->year(),
            'serie_probatoire_gen' => $this->faker->word(),
            'price_probatoire_gen' => $this->faker->randomFloat(2, 10, 100),
            'file_probatoire_gen' => $this->faker->url(),
            // Assuming teacher_id_probatoire_gen is a foreign key referencing the teachers table
            'teacher_id_probatoire_gen' => $this->faker->randomElement($teacheIds),
        ];
    }
}
