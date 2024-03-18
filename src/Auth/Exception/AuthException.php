<?php

namespace App\Auth\Exception;

use App\User\User;

class AuthException extends \Exception
{
    public function __construct(User $user, int $code = 0, ?\Throwable $previous = null)
    {
        $message = sprintf("User with name %s failed authentication", $user->getName());

        parent::__construct($message, $code, $previous);
    }
}
