<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PenyesuaianTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('roles');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('status', ["ACTIVE", "INACTIVE"]);
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
            $table->dropColoumn('username');
            $table->dropColoumn('roles');
            $table->dropColoumn('address');
            $table->dropColoumn('phone');
            $table->dropColoumn('avatar');
            $table->dropColoumn('status');
        });
    }
}
