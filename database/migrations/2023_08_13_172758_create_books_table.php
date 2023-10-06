
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('call_number'); 
            $table->string('title');
            $table->string('author');
            $table->integer('volume');
            $table->json('access_no')->nullable();
            $table->integer('year');
            $table->string('publish');
            $table->boolean('availability')->default(true);
            $table->json('program_hide_request')->nullable();
            $table->json('program_hidden')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
