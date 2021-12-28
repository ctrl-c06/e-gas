<?php

namespace App\Http\Controllers;

use App\Models\FuelSlip;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use chillerlan\QRCode\QRCode;
use App\Repositories\Encryptor;
use Illuminate\Support\Facades\App;

class PrintSlipController extends Controller
{
    public function print()
    {
        $slips = FuelSlip::get();
        $encryptor = new Encryptor("10001", 5);
        $qr = new QRCode();
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->setOption('header-html',  view('print.header'));
        $pdf->loadView('print.slip', compact('slips', 'encryptor', 'qr'))
                    ->setPaper('a4', 'portrait');
        return $pdf->inline();
    }

    public function printSlip($key)
    {
        $slip = null;
        if(Str::contains($key, "&")) {
            // keys need to explode
            $ids = explode("&", $key);
            $ids = array_map('intval', $ids);
            $slips = FuelSlip::whereIn('id', $ids)->get();
        } else {
            // Just fetch the single record.
            $slips = FuelSlip::where('id', $key)->get();
        }
        $encryptor = new Encryptor("10001", 5);
        $qr = new QRCode();
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->setOption('header-html',  view('print.header'));
        $pdf->loadView('print.one-slip', compact('slips', 'encryptor', 'qr'))
                    ->setPaper('a4', 'portrait');
        return $pdf->inline();
    }

    
}
