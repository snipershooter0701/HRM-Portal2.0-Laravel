<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('client_id');
            $table->integer('placement_id');
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('job_tire_id');
            $table->string('attachment');
            $table->text('report');
            $table->integer('status')->default(0)->comment('0: Submitted, 1: Approved, 2: Rjected');
            $table->integer('doc_type')->default(0)->comment('0: Normal, 1: Due');
            $table->date('submitted_on');
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
