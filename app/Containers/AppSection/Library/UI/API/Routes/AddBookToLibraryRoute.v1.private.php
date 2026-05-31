<?php

/**
 * @apiGroup           Library
 * @apiName            AddBook
 *
 * @api                {POST} /v1/library/books Add Book
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

use App\Containers\AppSection\Library\UI\API\Controllers\LibraryController;
use Illuminate\Support\Facades\Route;

Route::post('library/books', [LibraryController::class, 'addBook'])
    ->middleware(['auth:api']);

