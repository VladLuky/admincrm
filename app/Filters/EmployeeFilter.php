<?php


namespace App\Filters;


class EmployeeFilter extends QueryFilter
{
    public function names($names = ''){
        return $this->builder->when($names, function ($query) use($names){
           $query->where('name', 'like', '%'.$names.'%');
        });
    }

    public function pos_names($pos_names = ''){
        return $this->builder->when($pos_names, function ($query) use ($pos_names){
            $query->where('position', $pos_names);
        });
    }

    public function min_data($min_data = ''){
        return $this->builder->when($min_data, function ($query) use ($min_data){
            $query->whereDate('date', '>=', $min_data);
        });
    }

    public function max_data($max_data = ''){
        return $this->builder->when($max_data, function ($query) use ($max_data){
            $query->whereDate('date', '<=', $max_data);
        });
    }

    public function phones($phones = ''){
        return $this->builder->when($phones, function ($query) use ($phones){
            $query->where('phone', 'like','%'.$phones.'%');
        });
    }

    public function emails($emails = ''){
        return $this->builder->when($emails, function ($query) use ($emails){
            $query->where('email', 'like', '%'.$emails.'%');
        });
    }

    public function min_salary($min_salary = ''){
        return $this->builder->when($min_salary, function ($query) use ($min_salary){
            $query->where('salary', '>=', $min_salary);
        });
    }

    public function max_salary($max_salary = ''){
        return $this->builder->when($max_salary, function ($query) use ($max_salary){
            $query->where('salary', '<=', $max_salary);
        });
    }
}
