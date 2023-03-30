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
        Schema::create('awaiting_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('client_id');
            $table->integer('invoice_frequency')->default(0)->comment('0:weekly, 1:by-weekly, 2:monthly, 3:quarterly');
            $table->date('invoice_from');
            $table->date('invoice_to');
            $table->string('total_hours');
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
        Schema::dropIfExists('awaiting_invoices');
    }
};
