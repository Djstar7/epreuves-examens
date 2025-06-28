<?php

namespace Database\Seeders;

use App\Models\BacGenModel;
use App\Models\BacTechModel;
use App\Models\BepcModel;
use App\Models\BtsModel;
use App\Models\CapModel;
use App\Models\ConcoursModel;
use App\Models\ProbatoireGenModel;
use App\Models\ProbatoireTechModel;
use App\Models\OrderModel;
use App\Models\StudentModel;
use App\Models\TeacherModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        StudentModel::factory(10)->create();
        TeacherModel::factory(10)->create();

        BepcModel::factory(10)->create();
        CapModel::factory(10)->create();
        ProbatoireGenModel::factory(10)->create();
        ProbatoireTechModel::factory(10)->create();
        BacGenModel::factory(10)->create();
        BacTechModel::factory(10)->create();
        ConcoursModel::factory(10)->create();
        BtsModel::factory(10)->create();

        OrderModel::factory(10)->create();
    }
}
