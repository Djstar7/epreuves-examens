<?php

namespace App\Models;

use App\Models\OrderModel;
use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BepcModel extends Model
{
    use HasFactory;
    protected $table = 'bepc';
    
    protected $fillable = [
        'teacher_id_bepc',
        'subject_bepc',
        'year_bepc',
        'price_bepc',
        'file_bepc',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class, 'teacher_id_bepc');
    }
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'bepc_id_orders');
    }
}
