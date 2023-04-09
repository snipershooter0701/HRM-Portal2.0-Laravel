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
        Schema::create('client_placements', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('employee_id');
            $table->integer('job_tire_id');
            $table->integer('net_terms');
            $table->string('po_attachment');
            $table->integer('po_id');
            $table->integer('client_bill_rate')->default(0);
            $table->integer('client_ot_bill_rate')->nullable();
            $table->integer('client_dt_bill_rate')->nullable();
            $table->integer('client_vendor_id')->nullable();
            $table->integer('vendor_contractor_id')->nullable();
            $table->integer('vendor_contractor_netterms')->nullable();
            $table->string('vendor_contractor_po_attachment')->nullable();
            $table->integer('vendor_contractor_po_id')->nullable();
            $table->integer('vendor_contractor_bill_rate')->default(0);
            $table->integer('vendor_contractor_at_bill_rate')->nullable();
            $table->integer('vendor_contractor_dt_bill_rate')->nullable();
            $table->string('job_title');
            $table->integer('job_status')->default(0)->comment('0: Inactive, 1: Active');
            $table->date('job_start_date');
            $table->date('job_end_date');
            $table->integer('invoice_frequency')->default(0)->comment('0: Weekly, 1: By-Weekly, 2: Monthly, 3: Quarterly');
            $table->date('pay_effect_date');
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
        Schema::dropIfExists('client_placements');
    }
};