<?php

namespace App\Containers\AppSection\Library\Tasks;

use App\Containers\AppSection\Library\Models\UserBookLibrary;
use App\Ship\Parents\Tasks\Task as ParentTask;

class AddBookToLibraryTask extends ParentTask
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(int $userId, int $bookId): bool
    {
        $library = UserBookLibrary::firstOrCreate([
            'user_id' => $userId,
            'book_id' => $bookId,
        ]);

        return $libraryBook->wasRecentlyCreated;
    }
}
