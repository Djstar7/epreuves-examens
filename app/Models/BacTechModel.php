<?php

namespace App\Models;

use App\Models\OrderModel;
use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BacTechModel extends Model
{
    use HasFactory;
    protected $table = 'bac_tech';
    
    protected $fillable = [
        'teacher_id_bac_tech',
        'subject_bac_tech',
        'year_bac_tech',
        'branch_bac_tech',
        'price_bac_tech',
        'file_bac_tech',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class, 'teacher_id_bac_tech');
    }
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'bac_id_orders');
    }
}
