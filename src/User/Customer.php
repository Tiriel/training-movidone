<?php

namespace App\User;

use App\Strategy\Formatter\Enum\FormatEnum;

class Customer extends User
{

    public function getPreferredFormat(): FormatEnum
    {
        return FormatEnum::Json;
    }
}
