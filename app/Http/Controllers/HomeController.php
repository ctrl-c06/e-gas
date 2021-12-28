<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\FuelSlip;
use App\Models\UpdateLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller 
{

 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $firstSlip = FuelSlip::orderBy('created_at')->first();
        $lastSlip = FuelSlip::orderBy('created_at', 'DESC')->first();
        $generatedFuelSlips = FuelSlip::count();
        $administrators = User::count();
        $deletedSlips = DB::table('fuel_slips')->where('deleted_at', '!=', null)->count();
        return view('administrator.dashboard', compact('generatedFuelSlips', 'firstSlip', 'lastSlip', 'administrators', 'deletedSlips'));
    }
}
