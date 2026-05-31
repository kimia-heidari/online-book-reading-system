<?php

namespace App\Containers\AppSection\UserBook\Tasks;

use App\Containers\AppSection\Library\Models\UserBook;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\DB;

class OpenBookTask extends ParentTask
{
    public function run(
        int $userId,
        int $bookId
    ): UserBook {
        return DB::transaction(function () use ($userId, $bookId) {

            // deactivate all user books
            UserBook::query()
                ->where('user_id', $userId)
                ->where('is_active', true)
                ->update([
                    'is_active' => false,
                ]);

            // get or create book in library
            $userBook = UserBook::firstOrCreate(
                [
                    'user_id' => $userId,
                    'book_id' => $bookId,
                ],
                [
                    'last_page' => 1,
                    'is_active' => false,
                ]
            );

            // make current book active
            $userBook->update([
                'is_active' => true,
                'last_read_at' => now(),
            ]);

            return $userBook;
        });
    }
}
