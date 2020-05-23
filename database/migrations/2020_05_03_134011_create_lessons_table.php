<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger( 'deputy_id' )->unsigned();
            $table->bigInteger( 'schedule_id' )->unsigned();
            $table->date( 'lesson_date' );
            $table->bigInteger( 'term_id' );                                 ###### dodane
            $table->bigInteger( 'school_week' )->unsigned();
            $table->boolean( 'took_place' )->default( FALSE );
            $table->tinyInteger( 'presences' )->unsigned()->default(0);
            $table->tinyInteger( 'absences' )->unsigned()->default(0);

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('deputy_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');

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
        Schema::dropIfExists('lessons');
    }
}
