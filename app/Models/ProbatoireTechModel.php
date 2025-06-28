<?php

namespace App\Models;

use App\Models\OrderModel;
use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProbatoireTechModel extends Model
{
    use HasFactory;
    protected $table = 'probatoire_tech';
    protected $fillable = [
        'teacher_id_probatoire_tech',
        'subject_probatoire_tech',
        'year_probatoire_tech',
        'branch_probatoire_tech',
        'price_probatoire_tech',
        'file_probatoire_tech',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class, 'teacher_id_probatoire_tech');
    }
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'probatoire_tech_id_orders');
    }
}
