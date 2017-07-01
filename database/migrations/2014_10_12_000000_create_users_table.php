<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('first_name', 25)->nullable(false);
            $table->string('last_name', 25)->nullable(false);
            $table->string('phone', 20)->nullable();
            $table->string('email', 45)->nullable(false)->unique();
            $table->string('password')->nullable(false);
            //$table->string('ip_address', 45)->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->enum('role', ['administrator', 'colaborator']);
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
