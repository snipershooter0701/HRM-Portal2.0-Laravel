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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->integer('employment_type')->default(0)->comment('0: Employee, 1: Contractor');
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('title');
            $table->string('phone_num');
            $table->date('dateofbirth');
            $table->date('dateofjoining');
            $table->integer('gender')->default(0)->comment('0: Male, 1: Female');
            $table->integer('category')->default(0)->comment('0: W2, 1: C2C, 2: 1099');
            $table->integer('employee_type')->default(0)->comment('0: Employee/Contractor, 1: Back-office Staff');
            $table->integer('status')->default(0)->comment('0: Inactive, 1: Active');
            $table->date('status_end_date')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('poc_id');
            $table->integer('classification')->default(0)->comment('1: Billable, 0: Non-billable');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->string('city_town');
            $table->string('suite_aptno');
            $table->string('street');
            $table->string('zipcode');
            $table->integer('pay_standard_time')->default(1)->comment('0: Uncheck, 1: Check');
            $table->integer('pay_over_time')->default(0)->comment('0: Uncheck, 1: Check');
            $table->integer('pay_double_time')->default(0)->comment('0: Uncheck, 1: Check');
            $table->integer('pay_scale')->default(0)->comment('0: Pay % scale, 1: Pay rate scale');
            $table->integer('pay_percent_value')->default(75);
            $table->integer('pay_percent_hrs')->default(1920);
            $table->integer('pay_percent_to')->default(80);
            $table->integer('pay_rate_value')->default(75);
            $table->integer('pay_rate_hrs')->default(1920);
            $table->integer('pay_rate_to')->default(80);
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
        Schema::dropIfExists('employees');
    }
};