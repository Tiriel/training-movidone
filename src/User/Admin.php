<?php

namespace App\User;

use App\Strategy\Formatter\Enum\FormatEnum;
use App\User\Enum\AdminLevel;

class Admin extends Member
{
    protected static int $count = 0;

    public function __construct(
        string $name,
        string $login,
        string $password,
        int $age,
        protected AdminLevel $level = AdminLevel::Admin,
    ) {
        parent::__construct($name, $login, $password, $age);
    }

    public function auth(string $login, string $password): bool
    {
        if (AdminLevel::SuperAdmin === $this->level) {
            return true;
        }

        return parent::auth($login, $password);
    }

    public function getLevel(): string
    {
        return $this->level->getLabel();
    }

    public function getPreferredFormat(): FormatEnum
    {
        return FormatEnum::Html;
    }
}
