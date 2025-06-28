<?php

namespace Database\Factories;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BepcModel>
 */
class bepcModelFactory extends Factory
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
            'subject_bepc' => $this->faker->domainWord(),
            'year_bepc' => $this->faker->year(),
            'price_bepc' => $this->faker->randomFloat(2, 10, 100),
            'file_bepc' => $this->faker->url(),
            // Assuming teacher_id_bepc is a foreign key referencing the teachers table
            'teacher_id_bepc' => $this->faker->randomElement($teacheIds),
        ];
    }
}
