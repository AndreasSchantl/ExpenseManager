<?php

namespace App\Http\Controllers;

use App\Bill;
use App\ExpenseType;
use Carbon\Carbon;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->validate(request(), [
            'month' => 'numeric',
            'year' => 'numeric',
        ]);

        $month = request('month') ?? Carbon::now()->month;
        $year = request('year') ?? Carbon::now()->year;

        if ($month != 0) {
            $billBuilder = Bill::whereMonth('date', '=', $month)->whereYear('date', '=', $year);
        } else {
            $billBuilder = Bill::whereYear('date', '=', $year);
        }

        if (request('search')) {
            $types = ExpenseType::where('name', 'LIKE', '%' . request('search') . '%')->get()->pluck('id')->toArray();

            $billBuilder = $billBuilder->where('description', 'LIKE', '%' . request('search') . '%')
                ->orWhereIn('type', $types);
        }

        $bills = $billBuilder->orderBy('date')->get();
        $total = $billBuilder->sum('amount');

        return view('bills.index', array('month' => $month, 'year' => $year, 'bills' => $bills, 'total' => $total));
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
            'description' => 'required|min:3|max:70',
            'amount' => 'required|numeric',
            'type' => 'required',
            'date' => 'required|date',
            'guarantee' => 'boolean'
        ]);

        $bill = Bill::create(request()->all());

        try {
            $bill->save();
            return back()->with('info', __('app.exp_info_created', ['date' => $bill->date->format(env('DATE_FORMAT')), 'desc' => $bill->description]));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::findOrFail($id);
        return view('bills.edit', array('bill' => $bill));
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
            'description' => 'required|min:3|max:70',
            'amount' => 'required|numeric',
            'type' => 'required',
            'date' => 'required|date',
            'guarantee' => 'boolean'
        ]);

        $bill = Bill::findOrFail($id);
        $bill->guarantee = false;
        $bill->fill(request()->all());

        try {
            $bill->save();

            return redirect('/expenses')->with('info', __('app.exp_info_updated', ['date' => $bill->date->format(env('DATE_FORMAT')), 'desc' => $bill->description]));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove a bill
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var Bill $bill */
        $bill = Bill::findOrFail($id);

        try {
            $bill->delete();
            return back()->with('info', __('app.exp_info_deleted', ['date' => $bill->date->format(env('DATE_FORMAT')), 'desc' => $bill->description]));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
