<?php

namespace Database\Factories;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConcoursModel>
 */
class concoursModelFactory extends Factory
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
            'subject_concours' => $this->faker->word(),
            'year_concours' => $this->faker->year(),
            'school_concours' => $this->faker->word(),
            'cycle_concours' => $this->faker->word(),
            'speciality_concours' => $this->faker->word(),
            'price_concours' => $this->faker->randomFloat(2, 10, 100),
            'file_concours' => $this->faker->url(),
            // Assuming teacher_id_concours is a foreign key referencing the teachers table
            'teacher_id_concours' => $this->faker->randomElement($teacheIds),
        ];
    }
}
