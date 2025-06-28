<?php

namespace App\Models;

use App\Models\OrderModel;
use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcoursModel extends Model
{
    use HasFactory;
    protected $table = 'concours';
    protected $fillable = [
        'teacher_id_concours',
        'subject_concours',
        'year_concours',
        'school_concours',
        'cycle_concours',
        'speciality_concours',
        'price_concours',
        'file_concours',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class, 'teacher_id_concours');
    }
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'concours_id_orders');
    }
}
