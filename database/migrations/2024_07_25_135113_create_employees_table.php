<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_register_number')->unique();
            $table->string('name');
            $table->string('contact_number')->unique();
            $table->string('email')->unique();
            $table->date('date_of_birth');
            $table->text('address')->nullable();
            // $table->foreignId('department_id')->constrained()->onDelete('cascade');
            // $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
