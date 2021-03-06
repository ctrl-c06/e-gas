<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelSlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_slips', function (Blueprint $table) {
            $table->id();
            $table->date('issued_date');
            $table->string('gasoline_station');
            $table->float('no_of_liters');
            $table->string('name')->nullable()->default('-');
            $table->string('vehicle_plate_no')->nullable()->default('-');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuel_slips');
    }
}
