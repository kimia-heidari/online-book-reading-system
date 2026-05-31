<?php

namespace App\Containers\AppSection\Book\Data\Repositories;

use App\Containers\AppSection\Book\Models\Book;
use App\Containers\AppSection\Book\Models\BookPage;
use Illuminate\Support\Facades\Cache;

class BookCacheRepository
{
    public function getBook(int $bookId): Book
    {
        return Cache::remember(
            BookCacheKeys::book($bookId),
            now()->addDay(),
            fn () => Book::findOrFail($bookId)
        );
    }

    public function getPage(
        int $bookId,
        int $pageNumber
    ): BookPage {
        return Cache::remember(
            BookCacheKeys::page(
                $bookId,
                $pageNumber
            ),
            now()->addDay(),
            fn () => BookPage::query()
                ->where('book_id', $bookId)
                ->where('page_number', $pageNumber)
                ->firstOrFail()
        );
    }

    public function forgetBook(int $bookId): void
    {
        Cache::forget(
            BookCacheKeys::book($bookId)
        );
    }

    public function forgetPage(
        int $bookId,
        int $pageNumber
    ): void {
        Cache::forget(
            BookCacheKeys::page(
                $bookId,
                $pageNumber
            )
        );
    }
}