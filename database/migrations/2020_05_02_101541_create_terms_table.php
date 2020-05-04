<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger( 'start_hour' )->default(7);
            $table->tinyInteger( 'start_minute' )->default(15);
            $table->tinyInteger( 'end_hour' )->default(15);
            $table->tinyInteger( 'end_minute' )->default(20);

            $table->tinyInteger( 'week_day' )->default(1);

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
        Schema::dropIfExists('terms');
    }
}
