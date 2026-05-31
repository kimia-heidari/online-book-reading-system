<?php

namespace App\Containers\AppSection\UserBook\Tasks;

use App\Containers\AppSection\Book\Models\Book;
use App\Containers\AppSection\UserBook\Models\UserBook;
use App\Ship\Parents\Tasks\Task as ParentTask;

class CalculateNextPageTask extends ParentTask
{
    public function run(UserBook $userBook, Book $book): ?int
    {
        return $userBook->last_page >= $book->total_pages ? null : $userBook->last_page + 1;
    }
}
