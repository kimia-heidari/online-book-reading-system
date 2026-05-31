<?php

namespace App\Containers\AppSection\Library\Exceptions;

use App\Ship\Parents\Exceptions\Exception as ParentException;

class BookAlreadyInLibraryException extends ParentException
{
    protected $message = 'Book is already in your library.';
}
