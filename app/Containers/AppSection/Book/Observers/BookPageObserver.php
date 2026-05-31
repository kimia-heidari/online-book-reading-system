<?php

namespace App\Containers\AppSection\Book\Observers;

use App\Containers\AppSection\Book\Data\Repositories\BookCacheRepository;
use App\Containers\AppSection\Book\Models\BookPage;

class BookPageObserver
{
    public function updated(BookPage $page): void
    {
        Cache::forget(
            BookCacheKeys::page(
                $page->book_id,
                $page->page_number
            )
        );
    }

    public function deleted(BookPage $page): void
    {
        Cache::forget(
            BookCacheKeys::page(
                $page->book_id,
                $page->page_number
            )
        );
    }
}