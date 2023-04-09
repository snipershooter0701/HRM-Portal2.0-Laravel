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
        Schema::create('client_confidentials', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('bankname');
            $table->string('accounttype');
            $table->string('accountnumber');
            $table->string('routingnumber');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->string('city');
            $table->string('suite_aptno');
            $table->string('street');
            $table->string('zipcode');
            $table->string('cancelled_check')->nullable();
            $table->string('other_attachment')->nullable();
            $table->integer('status')->default(0)->comment('0: Inactive, 1: Active');
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
        Schema::dropIfExists('client_confidentials');
    }
};
