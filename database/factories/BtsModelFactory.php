<?php

namespace Database\Factories;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BtsModel>
 */
class btsModelFactory extends Factory
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
            'subject_bts' => $this->faker->words(10, true),
            'year_bts' => $this->faker->year(),
            'branch_bts' => $this->faker->word(),
            'speciality_bts' => $this->faker->word(),
            'price_bts' => $this->faker->randomFloat(2, 10, 100),
            'file_bts' => $this->faker->url(),
            // Assuming teacher_id_bts is a foreign key referencing the teachers table
            'teacher_id_bts' => $this->faker->randomElement($teacheIds),
        ];
    }
}
