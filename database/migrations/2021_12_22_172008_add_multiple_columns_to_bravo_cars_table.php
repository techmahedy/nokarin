<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnsToBravoCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bravo_cars', function (Blueprint $table) {
            $table->foreignId('vehicle_category_id')->nullable();
            $table->string('year_model')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->foreignId('car_body_type_id')->nullable();
            $table->string('plate_conduction_sticker')->nullable();
            $table->string('mv_file_no')->nullable();
            $table->string('garage_area')->nullable();
            $table->string('copy_of_orcr')->nullable();
            $table->string('insurance_name')->nullable();
            $table->string('copy_of_insurance')->nullable();
            $table->string('deed_of_sale_if_applicable')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bravo_cars', function (Blueprint $table) {
            //
        });
    }
}
