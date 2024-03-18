<?php

namespace App\Strategy\Formatter;

class JsonFormatter implements Interface\FormatterInterface
{

    public function format(string $message): string
    {
        return \json_encode($message);
    }

    public function getFormat(): string
    {
        return 'json';
    }
}
