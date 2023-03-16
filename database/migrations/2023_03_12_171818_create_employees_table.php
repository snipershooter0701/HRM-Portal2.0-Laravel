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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("middle_name");
            $table->string("last_name");
            $table->string("job_title");
            $table->string("email_address");
            $table->string("phone_number");
            $table->date("date_of_birth");
            $table->string("employee_title");
            $table->date("date_of_joining");
            $table->integer("gender")->default(0);
            $table->string("employment_type");
            $table->string("category");
            $table->string("employee_type");
            $table->integer("employee_id");
            $table->integer("employee_status")->default(0);
            $table->string("department");
            $table->date("employee_status_date");
            $table->integer("poc");
            $table->integer("classification")->default(0);
            $table->string("address_line");
            $table->string("apt_no");
            $table->string("city_town");
            $table->string("state");
            $table->string("zip_code");
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
        Schema::dropIfExists('employees');
    }
};