<?php

namespace Database\Factories;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BacTechModel>
 */
class bacTechModelFactory extends Factory
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
            'subject_bac_tech' => $this->faker->word(),
            'year_bac_tech' => $this->faker->year(),
            'branch_bac_tech' => $this->faker->word(),
            'price_bac_tech' => $this->faker->randomFloat(2, 10, 100),
            'file_bac_tech' => $this->faker->url(),
            // Assuming teacher_id_bac_tech is a foreign key referencing the teachers table
            'teacher_id_bac_tech' => $this->faker->randomElement($teacheIds),
        ];
    }
}
