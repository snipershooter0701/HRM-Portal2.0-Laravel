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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('department_id');
            $table->string('subject');
            $table->string('attachment');
            $table->text('details');
            $table->date('created_on')->nullable();
            $table->date('closed_on')->nullable();
            $table->integer('assigned_id')->nullable();
            $table->integer('status')->default(0)->comment('0: Requested, 1: Assigned, 2: Completed');
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
        Schema::dropIfExists('tickets');
    }
};