<?php

namespace App\Containers\AppSection\Library\Tasks;

use App\Containers\AppSection\UserBook\Models\UserBook;
use App\Ship\Parents\Tasks\Task as ParentTask;

class BookExistInLibraryTask extends ParentTask
{
    public function run(int $userId, int $bookId): bool
    {
        return UserBook::where([
            'user_id' => $userId,
            'book_id' => $bookId,
            'is_active' => true,
        ])->exists();
    }
}
