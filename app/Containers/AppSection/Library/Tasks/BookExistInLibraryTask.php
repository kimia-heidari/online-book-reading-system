<?php

namespace App\Containers\AppSection\Library\Tasks;

use App\Containers\AppSection\Library\Models\UserBookLibrary;
use App\Ship\Parents\Tasks\Task as ParentTask;

class BookExistInLibraryTask extends ParentTask
{
    public function run(int $userId, int $bookId): bool
    {
        return UserBookLibrary::where([
            'user_id' => $userId,
            'book_id' => $bookId,
        ])->exists();
    }
}
