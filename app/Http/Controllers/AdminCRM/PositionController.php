<?php

namespace App\Http\Controllers\AdminCRM;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $position = Position::all();
        return view('admincrm.positions.index',[
            'position' => $position,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincrm.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position = new Position();
        $position->name = $request->get('name');
        $position->save();
        return redirect()->route('positions.index')->withSuccess('Position add!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('admincrm.positions.edit',[
            'position' => $position,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $position->name = $request->get('name');
        $position->save();

        return redirect()->route('positions.index')->withSuccess('Position update!');
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
            $position = Position::findOrFail($request['emp_id']);
            $position->delete();
            return redirect()->back()->withSuccess('Position deleted!');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Error delete!', $e);
        }
    }
}
