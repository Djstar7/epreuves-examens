<?php

namespace App\Models;

use App\Models\OrderModel;
use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BacGenModel extends Model
{
    use HasFactory;
    protected $table = 'bac_gen';
    protected $fillable = [
        'teacher_id_bac_gen',
        'subject_bac_gen',
        'year_bac_gen',
        'serie_bac_gen',
        'price_bac_gen',
        'file_bac_gen',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class, 'teacher_id_bac_gen');
    }
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'bac_gen_id_orders');
    }
}
