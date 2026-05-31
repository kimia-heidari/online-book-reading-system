<?php

namespace App\Containers\AppSection\UserBook\Tasks;

use App\Containers\AppSection\Library\Models\UserBook;
use App\Containers\AppSection\Book\Models\Book;
use App\Ship\Parents\Tasks\Task as ParentTask;

class TurnPageTask extends ParentTask
{
    public function run(int $userId, Book $book): UserBook
    {
        $userBook = UserBook::findOrFail(
            [
                'user_id' => $userId,
                'book_id' => $book->id,
                'is_active' => true
            ],
        );

        $newlastPage = min($userBook->last_page, $book->total_pages);

        $userBook->update([
            'last_page' => $newlastPage,
            'last_read_at' => now(),
        ]);

        return $userBook->refresh();
    }
}
