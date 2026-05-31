<?php

/**
 * @apiGroup           UserBook
 * @apiName            TurnBookPage
 *
 * @api                {PATCH} /v1/user/books/:bookid/turn-page Turn Book Page
 * @apiDescription     Endpoint description here...
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} parameters here...
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 *     // Insert the response of the request here...
 * }
 */

use App\Containers\AppSection\UserBook\UI\API\Controllers\UserBookController;
use Illuminate\Support\Facades\Route;

Route::patch('user/books/{book}/turn-page', [UserBookController::class, 'turnPage'])
    ->middleware(['auth:api']);

