<?php

namespace Database\Factories;

use App\Models\StudentModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentModel>
 */
class StudentModelFactory extends Factory
{

    protected $model = StudentModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_students' => $this->faker->userName(),
            'email_students' => $this->faker->unique()->safeEmail(),
            'password_students' =>  Hash::make('password'),
            'phone_students' => $this->faker->phoneNumber(),
        ];
    }
}