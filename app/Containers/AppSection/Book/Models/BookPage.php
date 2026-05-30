<?php

namespace App\Containers\AppSection\Book\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'page_number',
        'content',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
