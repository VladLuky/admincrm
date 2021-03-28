<?php


namespace App\Http\Controllers\Auth;


use Illuminate\Support\Facades\Auth;

class PermCheck
{
    public function index(){
        if ( Auth::user()->hasAnyRole(['admin']) ) {
           return redirect('admin');
        }

        return redirect('user');
    }
}
