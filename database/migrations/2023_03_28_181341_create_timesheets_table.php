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
            $table->integer('standard_mon')->comment('Unit: minute');
            $table->integer('standard_tue')->comment('Unit: minute');
            $table->integer('standard_wed')->comment('Unit: minute');
            $table->integer('standard_thu')->comment('Unit: minute');
            $table->integer('standard_fri')->comment('Unit: minute');
            $table->integer('standard_sat')->comment('Unit: minute');
            $table->integer('standard_sun')->comment('Unit: minute');
            $table->integer('over_time')->default(0)->comment('0: No, 1: Yes');
            $table->integer('over_mon')->comment('Unit: minute');
            $table->integer('over_tue')->comment('Unit: minute');
            $table->integer('over_wed')->comment('Unit: minute');
            $table->integer('over_thu')->comment('Unit: minute');
            $table->integer('over_fri')->comment('Unit: minute');
            $table->integer('over_sat')->comment('Unit: minute');
            $table->integer('over_sun')->comment('Unit: minute');
            $table->integer('double_time')->default(0)->comment('0: No, 1: Yes');
            $table->integer('double_mon')->comment('Unit: minute');
            $table->integer('double_tue')->comment('Unit: minute');
            $table->integer('double_wed')->comment('Unit: minute');
            $table->integer('double_thu')->comment('Unit: minute');
            $table->integer('double_fri')->comment('Unit: minute');
            $table->integer('double_sat')->comment('Unit: minute');
            $table->integer('double_sun')->comment('Unit: minute');

            $table->integer('total_billable_hours')->comment('Unit: minute');

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