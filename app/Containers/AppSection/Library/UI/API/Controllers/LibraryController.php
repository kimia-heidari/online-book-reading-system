<?php

namespace App\Containers\AppSection\Library\UI\API\Controllers;

use App\Containers\AppSection\Library\Actions\AddBookToLibraryAction;
use App\Containers\AppSection\Library\Exceptions\BookAlreadyInLibraryException;
use App\Containers\AppSection\Library\UI\API\Requests\AddBookToLibraryRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Throwable;

class LibraryController extends ApiController
{
    public function addBook(AddBookToLibraryRequest $request): JsonResponse
    {
        try {
            app(AddBookToLibraryAction::class)
                ->run(auth()->id(), $request->book_id);

            return response()->json([
                'status' => 'success',
                'message' => 'Book added successfully.',
            ]);
        } catch (BookAlreadyInLibraryException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ], 409);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
            ], 500);
        }
    }
}
