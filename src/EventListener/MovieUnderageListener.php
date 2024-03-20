<?php

namespace App\EventListener;

use App\Movie\Event\MovieUnderageEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class MovieUnderageListener
{
    #[AsEventListener(event: MovieUnderageEvent::class)]
    public function onMovieUnderageEvent(MovieUnderageEvent $event): void
    {
        // ...
    }
}
