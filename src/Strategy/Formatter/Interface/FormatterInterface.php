<?php

namespace App\Strategy\Formatter\Interface;

interface FormatterInterface
{
    public function format(string $message): string;

    public function getFormat(): string;
}
