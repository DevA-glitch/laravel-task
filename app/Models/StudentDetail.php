<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'number', 'roll_number', 'type', 'address'];

}
