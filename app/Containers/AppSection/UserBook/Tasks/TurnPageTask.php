<?php

namespace App\Containers\AppSection\UserBook\Tasks;

use App\Containers\AppSection\Book\Models\Book;
use App\Containers\AppSection\UserBook\Models\UserBook;
use App\Ship\Parents\Tasks\Task as ParentTask;

class TurnPageTask extends ParentTask
{
    public function run(int $userId, Book $book): UserBook
    {
        $userBook = UserBook::query()
            ->where('user_id', $userId)
            ->where('book_id', $book->id)
            ->where('is_active', true)
            ->firstOrFail();

        $newLastPage = min($userBook->last_page + 1, $book->total_pages);

        $userBook->update([
            'last_page' => $newLastPage,
            'last_read_at' => now(),
        ]);

        return $userBook->refresh();
    }
}
