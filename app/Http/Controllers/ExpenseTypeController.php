<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Ramsey\Uuid\Exception\UnsupportedOperationException;

class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('types.index', array('types' => ExpenseType::orderBy('name', 'asc')->get()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'parent' => 'required|numeric'
        ]);

        $e = new ExpenseType();
        $e->name = request('name');

        if (request('parent') != -1) {
            $e->parent = request('parent');
        }

        try {
            $e->save();
            return redirect('expensetypes')->with('info', __('app.type_info_created'));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $e = ExpenseType::findOrFail($id);
        return view('types.edit', array('type' => $e));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'parent' => 'required|numeric'
        ]);

        $e = ExpenseType::findOrFail($id);
        $e->name = request('name');

        if (request('parent') != -1) {
            $e->parent = request('parent');
        } else {
            $e->parent = null;
        }

        try {
            $e->save();
            return redirect('expensetypes')->with('info', __('app.type_info_updated', ['type' => $e->name]));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $e = ExpenseType::findOrFail($id);

        try {
            $e->delete();
            return back()->with('info', __('app.type_info_deleted', ['type' => $e->name]));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
