<?php

namespace App\Containers\AppSection\UserBook\Actions;

use App\Containers\AppSection\UserBook\Models\UserBook;
use App\Containers\AppSection\UserBook\Tasks\OpenBookTask;
use App\Containers\AppSection\UserBook\UI\API\Requests\OpenBookRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class OpenBookAction extends ParentAction
{
    public function run(OpenBookRequest $request): UserBook
    {
        return app(OpenBookTask::class)->run(
            auth()->id(),
            $request->book_id
        );
    }
}
