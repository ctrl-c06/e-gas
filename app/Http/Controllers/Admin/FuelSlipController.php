<?php

namespace App\Http\Controllers\Admin;

use App\Models\FuelSlip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;

class FuelSlipController extends Controller
{
    public function list()
    {
        return Laratables::recordsOf(FuelSlip::class);
    }

    public function index()
    {
        $slips = FuelSlip::get();
        return view('administrator.fuelslip.index', compact('slips'));
    }

    public function create()
    {
        return view('administrator.fuelslip.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date|after_or_equal:' . date('Y-m-d'),
            'gasoline_station' => 'required',
            'no_of_liters'     => ['required','numeric', 'min: 1','max: 99.99', 'regex: /^\d+(\.\d{1,2})?$/'],
            'name_of_driver'   => 'required',
            'vehicle_plate_no' => ['required', 'regex:/^\w{3}-\d{4}$/'],
        ]);

        FuelSlip::create([
            'issued_date'      => $request->date,
            'gasoline_station' => $request->gasoline_station,
            'no_of_liters'     => $request->no_of_liters,
            'name'             => $request->name_of_driver,
            'vehicle_plate_no'  => $request->vehicle_plate_no
        ]);

        return back()->with('success', 'You successfully create new fuel slip.');
    }

    public function edit(int $id)
    {
        $fuelSlip = FuelSlip::find($id);
        return view('administrator.fuelslip.edit', compact('fuelSlip'));
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'date' => 'required|date|after_or_equal:' . date('Y-m-d'),
            'gasoline_station' => 'required',
            'no_of_liters' => ['required','numeric', 'min:1','max:99.99', 'regex:/^\d+(\.\d{1,2})?$/'],
            'name_of_driver' => 'required',
            'vehicle_plate_no' => ['required', 'regex:/^\w{3}-\d{4}$/'],
        ]);

        $fuelSlip = FuelSlip::find($id);

        $fuelSlip->issued_date      = $request->date;
        $fuelSlip->gasoline_station = $request->gasoline_station;
        $fuelSlip->no_of_liters     = $request->no_of_liters;
        $fuelSlip->name             = $request->name_of_driver;
        $fuelSlip->vehicle_plate_no = $request->vehicle_plate_no;
        $fuelSlip->save();

        return back()->with('success', 'Fuel Slip successfully update');
    }

    public function destroy(int $id)
    {
        FuelSlip::find($id)->delete();
        return back()->with('success', 'Successfully delete a fuel slip');
    }
        
}
