<?php

namespace App\Containers\AppSection\Library\Actions;

use App\Containers\AppSection\Library\Exceptions\BookAlreadyInLibraryException;
use App\Containers\AppSection\Library\Tasks\AddBookToLibraryTask;
use App\Containers\AppSection\Library\Tasks\BookExistInLibraryTask;
use App\Ship\Parents\Actions\Action as ParentAction;

class AddBookToLibraryAction extends ParentAction
{
    public function run(int $userId, int $bookId): bool
    {
        $exists = app(BookExistInLibraryTask::class)->run($userId, $bookId);

        if ($exists) {
            throw new BookAlreadyInLibraryException();
        }

        return app(AddBookToLibraryTask::class)->run($userId, $bookId);
    }
}
