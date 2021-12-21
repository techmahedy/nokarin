<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_drivers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->enum('sex',['male','female']);
            $table->string('license_number');
            $table->date('license_expiry_date');
            $table->enum('license_type',['pro','non_pro']);
            $table->enum('restriction',[1,2,3,4,5,6]);
            $table->string('cp_contact_number');
            $table->string('id_picture')->nullable();
            $table->string('viber_number')->nullable();
            $table->string('fb_or_messenger_name')->nullable();
            $table->string('emg_cp_name')->nullable();
            $table->string('relation')->nullable();
            $table->string('authorization_letter')->nullable();
            $table->boolean('status')->default(false)->nullable();
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
        Schema::dropIfExists('vehicle_drivers');
    }
}
