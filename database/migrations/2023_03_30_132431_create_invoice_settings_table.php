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
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('auto_invocing')->default(0)->comment('0: inactive, 1: active');
            $table->integer('auto_invocing_type')->default(0)->comment('0: create invoice before month end, 1: custom select date the month');
            $table->integer('custom_select_date_mth_val')->nullable();
            $table->integer('auto_reminder')->default(0)->comment('0: inactive, 1: active');
            $table->integer('auto_reminder_type')->default(0)->comment('0: no of days, 1: net terms+ 7 days, 2:net terms + 10 days, 3: send reminder once every 10 days');
            $table->integer('auto_reminder_days')->nullable();
            $table->integer('vendor_svc_discount')->default(0)->comment('0: inactive, 1: active');
            $table->integer('vendor_svc_discount_type')->default(0)->comment('0: percent, 1: fixed');
            $table->integer('vendor_svc_percent')->nullable();
            $table->integer('vendor_svc_rate')->nullable();
            $table->integer('vendor_svc_type')->nullable();
            $table->integer('other_discount')->default(0)->comment('0: inactive, 1: active');
            $table->integer('other_discount_type')->default(0)->comment('0: percent, 1: fixed');
            $table->string('other_discount_percent_comment')->nullable();
            $table->integer('other_discount_percent_value')->nullable();
            $table->integer('other_discount_rate_value')->nullable();
            $table->integer('other_discount_rate_type')->nullable();
            $table->integer('include_due_payment')->default(0)->comment('0: inactive, 1: active');
            $table->integer('include_due_payment_type')->default(0)->comment('0: in email, 1: within invoice pdf');
            $table->integer('send_approved')->nullable();
            $table->string('send_approved_email')->nullable();
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
        Schema::dropIfExists('invoice_settings');
    }
};
