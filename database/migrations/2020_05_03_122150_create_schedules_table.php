<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->bigInteger( 'term_id' )->unsigned();
            $table->bigInteger( 'class_id' )->unsigned();
            $table->bigInteger( 'teacher_id' )->unsigned();
            $table->bigInteger( 'classroom_id' )->unsigned();
            $table->bigInteger( 'subject_id' )->unsigned();

            # $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            # $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            # $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            # $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            # $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

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
