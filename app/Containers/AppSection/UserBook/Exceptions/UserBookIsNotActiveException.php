<?php

namespace App\Containers\AppSection\UserBook\Exceptions;

use App\Ship\Parents\Exceptions\Exception as ParentException;

class UserBookIsNotActiveException extends ParentException
{
    protected $message = 'User book is not active.';
}
