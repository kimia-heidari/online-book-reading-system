<?php

namespace App\Containers\AppSection\UserBookHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Containers\AppSection\Book\Data\Factories\BookFactory;

class UserBookHistory extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return BookFactory::new();
    }

    protected $fillable = [
        'user_id',
        'book_id',
        'last_page',
        'is_active',
        'font_size',
        'last_read_at', 
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_read_at' => 'datetime',
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
