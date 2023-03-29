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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('doc_title_id')->comment('0: SSN, 1: Work Authorization, 2: State ID/Drive License, 3: Passport, 4: I-94, 5: Visa, 6: Other document');
            $table->string('comment')->nullable();
            $table->date('exp_date')->nullable();
            $table->integer('modified_by')->nullable();
            $table->date('modified_on')->nullable();
            $table->string('attachment');
            $table->integer('no');
            $table->integer('work_auth_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->integer('i-94-type')->default(0)->comment('0: D/S, 1: Other');
            $table->integer('other_type')->default(0)->comment('0: None, 1: D/A');
            $table->integer('employee_id');
            $table->integer('status')->default(0)->comment('0: Inactive, 1; Active');
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
        Schema::dropIfExists('documents');
    }
};
