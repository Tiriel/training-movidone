<?php

namespace App\Strategy\Formatter;

class PlaintextFormatter implements Interface\FormatterInterface
{

    public function format(string $message): string
    {
        return $message;
    }

    public function getFormat(): string
    {
        return 'plaintext';
    }
}
