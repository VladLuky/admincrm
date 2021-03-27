<?php

namespace App\Models;

use App\Filters\QueryFilter;
use App\Models\Filters\EmployeeFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function scopeFilter(Builder $builder,QueryFilter $filter){
        return $filter->apply($builder);
    }


}
