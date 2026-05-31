<?php

namespace App\Containers\AppSection\Book\Observers;

use App\Containers\AppSection\Book\Models\Book;
use App\Containers\AppSection\Book\Support\BookCacheKeys;
use Illuminate\Support\Facades\Cache;

class BookObserver
{
    public function updated(Book $book): void
    {
        Cache::forget(
            BookCacheKeys::book(
                $book->id,
            )
        );
    }

    public function deleted(Book $book): void
    {
        Cache::forget(
            BookCacheKeys::book(
                $book->id,
            )
        );
    }
}
