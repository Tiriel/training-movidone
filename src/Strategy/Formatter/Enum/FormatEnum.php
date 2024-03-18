<?php

namespace App\Strategy\Formatter\Enum;

enum FormatEnum
{
    case Plaintext;
    case Html;
    case Json;

    public function getFormat(): string
    {
        return match ($this) {
            self::Plaintext => 'plaintext',
            self::Html => 'html',
            self::Json => 'json',
        };
    }
}
