<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\StudentController;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'name', 'class','email', 'phone', 
    ];
}
