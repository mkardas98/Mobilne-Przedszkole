<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail', function (Blueprint $table) {
            $table->id();
            $table->string('from_name');
            $table->string('from_address');
            $table->string('host');
            $table->string('port');
            $table->string('user_name');
            $table->string('password');
            $table->string('encryption');
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
        Schema::dropIfExists('mail');
    }
}
