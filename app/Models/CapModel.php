<?php

namespace App\Models;

use App\Models\OrderModel;
use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapModel extends Model
{
    use HasFactory;
    protected $table = 'cap';
    protected $fillable = [
        'teacher_id_cap',
        'subject_cap',
        'year_cap',
        'branch_cap',
        'price_cap',
        'file_cap',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class, 'teacher_id_cap');
    }
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'cap_id_orders');
    }
}
