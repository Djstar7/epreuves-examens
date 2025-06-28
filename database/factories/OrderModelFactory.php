<?php

namespace Database\Factories;

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
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class OrderModelFactory extends Factory
{
public function definition(): array
{
    $faker = $this->faker;
    $examTypes = [
        'BEPC',
        'CAP',
        'Probatoire Genral',
        'Probatoire Technique',
        'Bac Genral',
        'Bac Technique',
        'Concours',
        'BTS',
    ];

    $examType = Arr::random($examTypes);
    $modelClass = match($examType) {
        'BEPC' => BepcModel::class,
        'CAP' => CapModel::class,
        'Probatoire Genral' => ProbatoireGenModel::class,
        'Probatoire Technique' => ProbatoireTechModel::class,
        'Bac Genral' => BacGenModel::class,
        'Bac Technique' => BacTechModel::class,
        'Concours' => ConcoursModel::class,
        'BTS' => BtsModel::class,
    };

    // Récupérer un enregistrement aléatoire du modèle correspondant
    $examPaper = $modelClass::inRandomOrder()->first();

    return [
        'student_id_orders' => StudentModel::inRandomOrder()->value('id'),
        'bepc_id_orders' => $examType === 'BEPC' ? $examPaper->id : null,
        'cap_id_orders' => $examType === 'CAP' ? $examPaper->id : null,
        'probatoire_gen_id_orders' => $examType === 'Probatoire Genral' ? $examPaper->id : null,
        'probatoire_tech_id_orders' => $examType === 'Probatoire Technique' ? $examPaper->id : null,
        'bac_gen_id_orders' => $examType === 'Bac Genral' ? $examPaper->id : null,
        'bac_tech_id_orders' => $examType === 'Bac Technique' ? $examPaper->id : null,
        'concours_id_orders' => $examType === 'Concours' ? $examPaper->id : null,
        'bts_id_orders' => $examType === 'BTS' ? $examPaper->id : null,
        'exam_name_orders' => $examType,
        'amount_orders' => $faker->randomFloat(2, 10, 1000),
        'payment_method_orders' => $faker->randomElement(['MTN', 'Moov', 'Orange']),
        'status_orders' => $faker->randomElement(['En-cours', 'Payer', 'Annuler']),
        'transaction_id_orders' => $faker->uuid(),
        'billing_address_orders' => $faker->address(),
    ];
}

}
