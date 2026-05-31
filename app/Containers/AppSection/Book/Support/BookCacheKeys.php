<?php

namespace App\Containers\AppSection\Book\Support;

class BookCacheKeys
{
    public static function book(int $bookId): string
    {
        return "book:{$bookId}";
    }

    public static function page(
        int $bookId,
        int $pageNumber
    ): string {
        return "book:{$bookId}:page:{$pageNumber}";
    }
}