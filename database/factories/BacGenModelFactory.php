<?php

namespace Database\Factories;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BacGenModel>
 */
class bacGenModelFactory extends Factory
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
            'subject_bac_gen' => $this->faker->word(),
            'year_bac_gen' => $this->faker->year(),
            'serie_bac_gen' => $this->faker->word(),
            'price_bac_gen' => $this->faker->randomFloat(2, 10, 100),
            'file_bac_gen' => $this->faker->url(),
            // Assuming teacher_id_bac_gen is a foreign key referencing the teachers table
            'teacher_id_bac_gen' => $this->faker->randomElement($teacheIds),
        ];
    }
}
