<?php

namespace App\Strategy;

use App\Strategy\Formatter\Interface\FormatterInterface;
use App\User\User;

class MessageSender
{
    public function __construct(
        /** @var FormatterInterface[] $formatters */
        protected readonly iterable $formatters,
    )
    {
    }

    public function send(User $user, string $message): void
    {
        $format = $user->getPreferredFormat();

        echo $this->formatters[$format->getFormat()]->format($message);
    }
}
