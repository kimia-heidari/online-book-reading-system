<?php

namespace App\Containers\AppSection\Library\Tasks;

use App\Containers\AppSection\UserBook\Models\UserBook;
use App\Containers\AppSection\Book\Models\Book;
use App\Ship\Parents\Tasks\Task as ParentTask;

class CalculateNextPageTask extends ParentTask
{
    public function run(UserBook $userBook, Book $book): ?int
    {
        // depends on product It can return to page one too.
        return $userBook->last_page >= $book->total_pages ? null : $userBook->last_page + 1;
    }
}
