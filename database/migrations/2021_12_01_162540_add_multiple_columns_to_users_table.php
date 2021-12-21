<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('vendor_type',['hotel','tours','staycation_rental','car_rental','events','flight'])->nullable();
            $table->string('car_operator_first_name')->nullable();
            $table->string('car_operator_last_name')->nullable();
            $table->string('car_operator_address')->nullable();
            $table->string('car_operator_identity_card')->nullable();
            $table->boolean('is_logistics')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
