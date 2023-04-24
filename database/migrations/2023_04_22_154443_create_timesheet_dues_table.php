<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheet_dues', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('client_id');
            $table->integer('placement_id');
            $table->integer('job_tire_id');
            $table->date('date_from');
            $table->date('date_to');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timesheet_dues');
    }
};