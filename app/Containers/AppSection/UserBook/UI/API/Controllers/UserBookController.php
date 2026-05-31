<?php

namespace App\Containers\AppSection\UserBook\UI\API\Controllers;

use App\Ship\Parents\Controllers\ApiController;
use App\Containers\AppSection\UserBook\UI\API\Requests\OpenBookRequest;
use App\Containers\AppSection\UserBook\Actions\OpenBookAction;
use Illuminate\Http\JsonResponse;
use Throwable;

class UserBookController extends ApiController
{
    public function openBook(
        OpenBookRequest $request,
        OpenBookAction $action
    ): JsonResponse {
        try {
            $userBook = $action->run($request);

            return response()->json([
                'status' => 'success',
                'last_page' => $userBook->last_page,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'failed',
            ], 500);
        }
    }
}
