<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('requested_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('fac_id')->nullable();
            $table->unsignedBigInteger('lib_id')->nullable();
            $table->unsignedBigInteger('pg_id')->nullable();
            $table->string('course_id');
            $table->string('program_name');
            $table->string('status');
            $table->timestamps();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('fac_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('lib_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('pg_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('course_id')->references('course_code')->on('courses')->onDelete('cascade');
            $table->foreign('program_name')->references('name')->on('programs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requested_books');
    }
};
