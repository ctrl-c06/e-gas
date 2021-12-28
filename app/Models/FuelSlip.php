<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function getVehiclePlateNoAttribute($value)
    {
        return Str::upper($value);
    }

    public function setVehiclePlateNoAttribute($value)
    {
        return $this->attributes['vehicle_plate_no'] = Str::upper($value);
    }

    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = Str::upper($value);
    }

    public function getNameAttribute($value)
    {
        return Str::upper($value);
    }


    public function setGasolineStationAttribute($value)
    {
        return $this->attributes['gasoline_station'] = Str::upper($value);
    }

    public function getGasolineStationAttribute($value)
    {
        return Str::upper($value);
    }
    

}
