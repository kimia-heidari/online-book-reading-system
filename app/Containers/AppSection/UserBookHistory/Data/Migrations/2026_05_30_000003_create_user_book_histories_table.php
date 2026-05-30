<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_book_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('book_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('last_page')->default(1);

            $table->boolean('is_active')->default(false);

            $table->unsignedInteger('font_size')->default(12);

            $table->timestamp('last_read_at')->nullable();

            $table->timestamps();

            $table->unique([
                'user_id',
                'book_id'
            ]);

            $table->index('book_id');
            $table->index('last_read_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_book_histories');
    }
}; 