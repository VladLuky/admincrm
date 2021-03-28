<?php

namespace App\Http\Controllers\AdminCRM;

use App\Filters\EmployeeFilter;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Position;
use App\Rules\EmployeeValidation;
use Illuminate\Http\Request;
use Image;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param EmployeeFilter $request
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeeFilter $request)
    {
        $employees = Employee::filter($request)->get();
        $positions = Position::all();
        return view('admincrm.employees.index', [
            'employees' => $employees,
            'positions' => $positions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::all();
        return view('admincrm.employees.create', [
            'positions' => $positions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['bail', 'required', 'string', new EmployeeValidation()],
            'email' => 'bail|required|email:rfc,dns',
            'salary' => 'bail|required|numeric|min:0|max:500000',
            'photo' => 'bail|required|mimes:jpg,png|max:5000|dimensions:min_width=300,min_height=300'

        ]);

        $employee = new Employee();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time();
            Image::make($file)
                ->resize(300, 300)
                ->save(public_path('/images/') . $filename . '.' . 'jpg', 80, 'jpg');
            $employee->photo = $filename . '.jpg';
        }
        $employee->name = $request->get('name');
        $employee->position = $request->get('pos_name');
        $employee->date = $request->get('date');
        $employee->phone = $request->get('phone');
        $employee->email = $request->get('email');
        $employee->salary = $request->get('salary');
        $employee->save();

        return redirect()->route('employees.index')->withSuccess('Employee add!');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $positions = Position::distinct()->get('name')->where('name', '!=', $employee['position']);
        return view('admincrm.employees.edit', [
            'positions' => $positions,
            'employee' => $employee,
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {


        $request->validate([
            'name' => ['bail', 'required', 'string', new EmployeeValidation()],
            'email' => 'bail|required|email:rfc,dns',
            'salary' => 'bail|required|numeric|min:0|max:500000',
            'photo' => 'bail|required|mimes:jpg,png|max:5000|dimensions:min_width=300,min_height=300'

        ]);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . 'jpg';
            Image::make($file)
                ->resize(300, 300)
                ->save(public_path('/images/') . $filename, 80, 'jpg');
            $employee->photo = $filename;
        }
        $employee->name = $request->get('name');
        $employee->position = $request->get('pos_name');
        $employee->date = $request->get('date');
        $employee->phone = $request->get('phone');
        $employee->email = $request->get('email');
        $employee->salary = $request->get('salary');
        $employee->save();

        return redirect()->route('employees.index')->withSuccess('Employee update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $employee = Employee::findOrFail($request['emp_id']);
            $employee->delete();
            return redirect()->back()->withSuccess('Employee deleted!');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Error delete!', $e);
        }

    }

}
