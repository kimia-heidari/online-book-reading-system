<?php

namespace App\Containers\AppSection\UserBook\UI\API\Controllers;

use App\Containers\AppSection\Book\Models\Book;
use App\Containers\AppSection\UserBook\Actions\OpenBookAction;
use App\Containers\AppSection\UserBook\Actions\TurnPageAction;
use App\Containers\AppSection\UserBook\UI\API\Requests\OpenBookRequest;
use App\Containers\AppSection\UserBook\UI\API\Requests\TurnPageRequest;
use App\Ship\Parents\Controllers\ApiController;
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

    public function turnPage(
        TurnPageRequest $request,
        Book $book,
        TurnPageAction $action,
    ): JsonResponse {
        try {
            $nextPage = $action->run($book);

            return response()->json([
                'status' => 'success',
                'next_page' => $nextPage,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'failed',
            ], 500);
        }
    }
}
