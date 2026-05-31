<?php

namespace App\Containers\AppSection\Book\Observers;

use App\Containers\AppSection\Book\Models\BookPage;
use App\Containers\AppSection\Book\Support\BookCacheKeys;
use Illuminate\Support\Facades\Cache;

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
