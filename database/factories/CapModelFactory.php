<?php

namespace Database\Factories;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CapModel>
 */
class capModelFactory extends Factory
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
            'subject_cap' => $this->faker->word(),
            'year_cap' => $this->faker->year(),
            'branch_cap' => $this->faker->word(),
            'price_cap' => $this->faker->randomFloat(2, 10, 100),
            'file_cap' => $this->faker->url(),
            // Assuming teacher_id_cap is a foreign key referencing the teachers table
            'teacher_id_cap' => $this->faker->randomElement($teacheIds),
        ];
    }
}
