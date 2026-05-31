<?php

namespace App\Containers\AppSection\UserBook\Actions;

use App\Containers\AppSection\UserBook\Actions\TurnPageAction;
use App\Containers\AppSection\Book\Models\Book;
use App\Containers\AppSection\UserBook\Tasks\CheckUserBookIsActive;
use App\Containers\AppSection\UserBook\Exceptions\UserBookIsNotActiveException;
use App\Containers\AppSection\UserBook\Tasks\TurnPageTask;
use App\Containers\AppSection\UserBook\Tasks\CalculateNextPageTask;
use App\Ship\Parents\Actions\Action as ParentAction;

class TurnPageAction extends ParentAction
{
    public function run(Book $book): ?int
    {
        $userId = auth()->id();
        $isActive = app(CheckUserBookIsActive::class)->run($userId, $book->id);

        if (!$isActive) {
            throw new UserBookIsNotActiveException();
        }

        $userBook = app(TurnPageTask::class)->run(
            userId,
            $book,
        );

        return app(CalculateNextPageTask::class)->run(
            $userBook,
            $book,
        );
    }
}
