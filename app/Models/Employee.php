<?php

namespace App\Models;

use App\Models\Filters\EmpFilter\EmployeeFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'photo',
        'name',
        'position',
        'date',
        'phone',
        'email',
        'salary'
    ];

}
