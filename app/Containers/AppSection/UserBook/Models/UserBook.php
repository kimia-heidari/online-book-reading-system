<?php

namespace App\Containers\AppSection\UserBook\Models;

use App\Containers\AppSection\Book\Models\Book;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBook extends Model
{
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
