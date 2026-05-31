<?php

namespace App\Containers\AppSection\Book\Observers;

use App\Containers\AppSection\Book\Data\Repositories\BookCacheRepository;
use App\Containers\AppSection\Book\Models\BookPage;

class BookObserver
{
    public function updated(BookPage $page): void
    {
        Cache::forget(
            BookCacheKeys::book(
                $page->book_id,
            )
        );
    }

    public function deleted(BookPage $page): void
    {
        Cache::forget(
            BookCacheKeys::book(
                $page->book_id,
            )
        );
    }
}