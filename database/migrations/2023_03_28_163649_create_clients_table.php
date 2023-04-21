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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('business_name');
            $table->string('contact_number');
            $table->integer('federal_id');
            $table->string('website');
            $table->integer('inv_country_id');
            $table->integer('inv_state_id');
            $table->string('inv_city');
            $table->string('inv_suite_aptno');
            $table->string('inv_street');
            $table->string('inv_zipcode');
            $table->integer('addr_sameas')->default(0)->comment('0: Inactive, 1: Active');
            $table->integer('addr_country_id');
            $table->integer('addr_state_id');
            $table->string('addr_city');
            $table->string('addr_suite_aptno');
            $table->string('addr_street');
            $table->string('addr_zipcode');
            $table->string('conf_bankname')->nullable();
            $table->string('conf_accounttype')->nullable();
            $table->string('conf_accountnumber')->nullable();
            $table->string('conf_routingnumber')->nullable();
            $table->integer('conf_country_id')->nullable();
            $table->integer('conf_state_id')->nullable();
            $table->string('conf_city')->nullable();
            $table->string('conf_suite_aptno')->nullable();
            $table->string('conf_street')->nullable();
            $table->string('conf_zipcode')->nullable();
            $table->string('conf_cancelled_check')->nullable();
            $table->integer('conf_status')->default(0)->comment('0: Inactive, 1: Active');
            $table->string('conf_other_attachment')->nullable();
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
        Schema::dropIfExists('clients');
    }
};