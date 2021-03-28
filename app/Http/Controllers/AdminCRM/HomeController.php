<?php

namespace App\Http\Controllers\AdminCRM;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $employees = Employee::all()->count();
        $positions = Position::all()->count();
        $users = User::all()->count();
        $admin = DB::table('model_has_roles')
            ->where('model_id', '=', '1')
            ->count();
        return view('admincrm.home.index', [
            'employees' => $employees,
            'positions' => $positions,
            'users' => $users,
            'admin' => $admin,
        ]);
    }
}
