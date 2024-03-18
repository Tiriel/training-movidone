<?php

namespace App\User\Interface;

use App\Strategy\Formatter\Enum\FormatEnum;

interface NotifiableInterface
{
    public function getPreferredFormat(): FormatEnum;
}
