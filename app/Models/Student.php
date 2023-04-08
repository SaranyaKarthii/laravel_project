<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'students';

    protected $fillable = [
        'name',
        'register_no',
        'email',
        'phone',
        'department_id',
        "year",
        "address_id"
    ];

    public function department(){
        return $this->belongsTo(Department::class, "department_id", "id");
    }

    public function address(){
        return $this->belongsTo(Address::class, "address_id", "id");
    }

}
