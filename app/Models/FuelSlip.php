<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelSlip extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'issued_date', 'gasoline_station', 'no_of_liters', 'name', 'vehicle_plate_no'  
    ];

    public $dates = [
        'created_at',
        'issued_date',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('F d, Y h:i A');
    }

    public static function laratablesCustomAction($data)
    {
        return view('administrator.fuelslip.includes.index_action', compact('data'))->render();
    }

}
