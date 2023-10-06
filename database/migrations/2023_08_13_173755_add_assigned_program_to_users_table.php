<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedProgramToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the assigned_program column
            $table->string('assigned_program')->nullable();

            // Add a foreign key constraint referencing the name column in the programs table
            $table->foreign('assigned_program')
                ->references('name')
                ->on('programs')
                ->onDelete('set null');
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
            // Drop the foreign key constraint
            $table->dropForeign(['assigned_program']);

            // Drop the assigned_program column
            $table->dropColumn('assigned_program');
        });
    }
}
