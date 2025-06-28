<?php

namespace App\Models;

use App\Models\OrderModel;
use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProbatoireGenModel extends Model
{
    use HasFactory;
    protected $table = 'probatoire_gen';
    protected $fillable = [
        'teacher_id_probatoire_gen',
        'subject_probatoire_gen',
        'year_probatoire_gen',
        'serie_probatoire_gen',
        'price_probatoire_gen',
        'file_probatoire_gen',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class, 'teacher_id_probatoire_gen');
    }
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'probatoire_gen_id_orders');
    }
}
