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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(0)->comment('0: Normal, 1: Due');
            $table->integer('employee_id');
            $table->integer('client_id');
            $table->integer('placement_id');
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('job_tire_id');
            $table->string('attachment');
            $table->text('report');
            $table->text('reason')->nullable();
            $table->date('submitted_on');

            $table->integer('standard_time')->default(1)->comment('0: No, 1: Yes');
            $table->string('standard_mon');
            $table->string('standard_tue');
            $table->string('standard_wed');
            $table->string('standard_thu');
            $table->string('standard_fri');
            $table->string('standard_sat');
            $table->string('standard_sun');
            $table->integer('over_time')->default(0)->comment('0: No, 1: Yes');
            $table->string('over_mon');
            $table->string('over_tue');
            $table->string('over_wed');
            $table->string('over_thu');
            $table->string('over_fri');
            $table->string('over_sat');
            $table->string('over_sun');
            $table->integer('double_time')->default(0)->comment('0: No, 1: Yes');
            $table->string('double_mon');
            $table->string('double_tue');
            $table->string('double_wed');
            $table->string('double_thu');
            $table->string('double_fri');
            $table->string('double_sat');
            $table->string('double_sun');

            $table->string('total_billable_hours');     

            $table->integer('status')->default(0)->comment('0: Submitted, 1: Approved, 2: Rjected');
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
        Schema::dropIfExists('timesheets');
    }
};