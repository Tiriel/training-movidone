<?php

namespace App\User;

use App\Auth\Exception\AuthException;
use App\Auth\Interface\AuthInterface;
use App\Strategy\Formatter\Enum\FormatEnum;

class Member extends User implements AuthInterface
{
    protected static int $count = 0;

    public function __construct(
        string $name,
        protected string $login,
        protected string $password,
        protected int $age
    ) {
        parent::__construct($name);
        static::$count++;
    }

    public function __destruct()
    {
        static::$count--;
    }

    public function auth(string $login, string $password): bool
    {
        if ($login !== $this->login || $password !== $this->password) {
            throw new AuthException($this);
        }

        return true;
    }

    public static function count(): int
    {
        return static::$count;
    }

    public function getPreferredFormat(): FormatEnum
    {
        return FormatEnum::Plaintext;
    }
}
