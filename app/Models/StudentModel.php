<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'name_students',
        'email_students',
        'password_students',
        'phone_students',
    ];
    protected $hidden = [
        'password_students',
    ];
    public $timestamps = false;
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'student_id_orders');
    }
}
