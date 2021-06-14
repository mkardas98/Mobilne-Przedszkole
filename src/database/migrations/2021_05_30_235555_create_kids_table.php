<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kids', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->integer('group_id')->default(0);
            $table->string('first_name', 30)->default('');
            $table->string('last_name', 30)->default('');
            $table->date('date_of_birth')->nullable();
            $table->string('pesel', 11)->default('')->nullable();
            $table->string('avatar')->default('')->nullable();
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
        Schema::dropIfExists('kids');
    }
}
