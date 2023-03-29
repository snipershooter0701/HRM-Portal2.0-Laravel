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
        Schema::create('client_notify_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('client_contact_id');
            $table->string('message');
            $table->integer('status')->default(0)->comment('0: Pending, 1: Saw');
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
        Schema::dropIfExists('client_notify_histories');
    }
};
