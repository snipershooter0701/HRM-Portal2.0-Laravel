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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('department_id');
            $table->integer('permission')->default(2)->comment('0: Admin, 1: Employee, 2: BackofficeStaff');
            $table->integer('access_view')->default(0)->comment('0: None, 1: Own, 2: Subordinates, 3: Own&Subordinates, 4: All Records');
            $table->integer('access_add')->default(0)->comment('0: Restricted, 1: Allowed to add');
            $table->integer('access_edit')->default(0)->comment('0: None, 1: Own, 2: Subordinates, 3: Own&Subordinates, 4: All Records');
            $table->integer('access_delete')->default(0)->comment('0: None, 1: Own, 2: Subordinates, 3: Own&Subordinates, 4: All Records');
            $table->integer('access_permission')->default(0);
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
        Schema::dropIfExists('roles');
    }
};