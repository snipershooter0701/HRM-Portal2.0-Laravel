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
        Schema::create('employee_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('ssn')->default(0)->comment('0: None, 1: Check, 2: Star');
            $table->integer('work_auth')->default(0)->comment('0: None, 1: Check, 2: Star');
            $table->integer('state')->default(0)->comment('0: None, 1: Check, 2: Star');
            $table->integer('passport')->default(0)->comment('0: None, 1: Check, 2: Star');
            $table->integer('i94')->default(0)->comment('0: None, 1: Check, 2: Star');
            $table->integer('visa')->default(0)->comment('0: None, 1: Check, 2: Star');
            $table->integer('other_document')->default(0)->comment('0: None, 1: Check, 2: Star');
            $table->longtext('comment');
            $table->date('requested_on')->nullable();
            $table->integer('requested_by_id')->nullable();
            $table->date('responsed_on')->nullable();
            $table->integer('approver_id')-nullable();
            $table->date('approved_on')->nullable();
            $table->integer('status')->default(0)->comment('0: Request, 1: Respond, 2: Approved, 3: Rejected');
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
        Schema::dropIfExists('employee_requests');
    }
};
