<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('author')->nullable();

            $table->string('slug')->unique();

            $table->unsignedInteger('total_pages')->default(1);

            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('author');
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}; 