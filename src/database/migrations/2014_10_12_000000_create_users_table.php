<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('login')->unique();
            $table->string('password');
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('address', 70)->default('')->nullable();
            $table->string('pesel', 11)->default('')->nullable();
            $table->string('phone', 16)->default('')->nullable();
            $table->string('avatar')->default('')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('role')->nullable();
            $table->string('specialization', 50)->default('')->nullable();
            $table->integer('kid_id')->default(0);
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
