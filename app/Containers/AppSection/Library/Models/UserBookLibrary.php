<?php

namespace App\Containers\AppSection\Library\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Containers\AppSection\Book\Data\Factories\BookFactory;

class UserBookLibrary extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
