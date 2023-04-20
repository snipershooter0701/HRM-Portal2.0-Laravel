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
        Schema::create('due_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('client_id');
            $table->date('invoice_date');
            $table->date('invoice_due_date');
            $table->integer('invoiced_amount');
            $table->integer('received_amount');
            $table->integer('invoice_frequency')->default(0)->comment('0:Weekly, 1:By-weekly, 2: Monthly, 3:Quarterly');
            $table->integer('net_terms')->default(0);
            $table->integer('include_po_attach')->default(0)->comment('0:No, 1:Yes');
            $table->string('invoice_recipient')->nullable();
            $table->string('invoice_cc_emails')->nullable();
            $table->string('invoice_bcc_emails')->nullable();
            $table->text('notes')->nullable();
            $table->text('statement_memo')->nullable();
            $table->string('attachment')->nullable();
            $table->text('payable_to')->nullable();
            $table->text('additional_info')->nullable();
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
        Schema::dropIfExists('due_invoices');
    }
};
