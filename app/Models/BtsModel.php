<?php

namespace App\Models;

use App\Models\OrderModel;
use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BtsModel extends Model
{
    use HasFactory;

    protected $table = 'bts';
    protected $fillable = [
        'teacher_id_bts',
        'subject_bts',
        'year_bts',
        'branch_bts',
        'speciality_bts',
        'price_bts',
        'file_bts',
    ];
    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class, 'teacher_id_bts');
    }
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'bts_id_orders');
    }
}
