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
        Schema::create('client_placement_docs', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('client_id');
            $table->integer('job_tire_id');
            $table->integer('client_placement_id');
            $table->integer('client_placement_doctype_id');
            $table->string('title');
            $table->string('comment');
            $table->date('expire_date');
            $table->string('attachment');
            $table->integer('status')->default(1)->comment("0: Inactive, 1: Active");
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
        Schema::dropIfExists('client_placement_docs');
    }
};
