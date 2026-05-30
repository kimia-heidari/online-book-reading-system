<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('book_pages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('book_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('page_number');

            $table->longText('content');

            $table->timestamps();

            $table->unique([
                'book_id',
                'page_number'
            ]);

            $table->index('book_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_pages');
    }
}; 