<?php

namespace Database\Factories;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherModel>
 */
class TeacherModelFactory extends Factory
{
    protected $model = TeacherModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        return [
                'name_teachers' => $faker->userName(),
                'email_teachers' => $faker->unique()->safeEmail,
                'password_teachers' => Hash::make('password'),
                'phone_teachers' => $faker->phoneNumber,
                'unique_id_teachers' => 'TCH' . $faker->unique()->numerify('####'),
        ];
    }
}
