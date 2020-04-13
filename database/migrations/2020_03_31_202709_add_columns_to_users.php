<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean( 'status' )->default( TRUE );
            $table->timestamp('last_login')->nullable();
            $table->boolean( 'role_admin' )->default( FALSE );
            $table->boolean( 'role_teacher' )->default( FALSE );
            $table->boolean( 'role_student' )->default( FALSE );
            $table->boolean( 'role_parent' )->default( FALSE );
            $table->boolean( 'role_director' )->default( FALSE );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('last_login');
            $table->dropColumn('role_admin');
            $table->dropColumn('role_teacher');
            $table->dropColumn('role_student');
            $table->dropColumn('role_parent');
            $table->dropColumn('role_director');
        });
    }
}
