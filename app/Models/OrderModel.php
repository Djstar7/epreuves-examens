<?php

namespace App\Models;

use App\Models\BacGenModel;
use App\Models\BacTechModel;
use App\Models\BepcModel;
use App\Models\BtsModel;
use App\Models\CapModel;
use App\Models\ConcoursModel;
use App\Models\ProbatoireGenModel;
use App\Models\ProbatoireTechModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'student_id_orders',
        'bepc_id_orders',
        'cap_id_orders',
        'probatoire_gen_id_orders',
        'probatoire_tech_id_orders',
        'bac_gen_id_orders',
        'bac_tech_id_orders',
        'concours_id_orders',
        'bts_id_orders',
        'exam_name_orders',
        'amount_orders',
        'status_orders',
        'payment_method_orders',
        'transaction_id_orders',
        'billing_address_orders',
    ];
    
    public function student()
    {
        return $this->belongsTo(StudentModel::class, 'student_id_orders');
    }
    public function bepc(){
        return $this->belongsTo(BepcModel::class, 'bepc_id_orders');
    }
    public function cap(){
        return $this->belongsTo(CapModel::class, 'cap_id_orders');
    }
    public function probatoireGen(){
        return $this->belongsTo(ProbatoireGenModel::class, 'probatoire_gen_id_orders');
    }
    public function probatoireTech(){
        return $this->belongsTo(ProbatoireTechModel::class, 'probatoire_tech_id_orders');
    }
    public function bacGen(){
        return $this->belongsTo(BacGenModel::class, 'bac_gen_id_orders');
    }
    public function bacTech(){
        return $this->belongsTo(BacTechModel::class, 'bac_tech_id_orders');
    }
    public function concours(){
        return $this->belongsTo(ConcoursModel::class, 'concours_id_orders');
    }
    public function bts(){
        return $this->belongsTo(BtsModel::class, 'bts_id_orders');
    }

}
