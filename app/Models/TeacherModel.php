<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherModel extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    protected $fillable = [
        'name_teachers',
        'email_teachers',
        'password_teachers',
        'phone_teachers',
    ];
    public $timestamps = false;
    protected $hidden = [
        'password_teachers',
    ];
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'teacher_id_orders');
    }
}
