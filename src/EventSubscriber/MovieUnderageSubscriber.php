<?php

namespace App\EventSubscriber;

use App\Movie\Event\MovieUnderageEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MovieUnderageSubscriber implements EventSubscriberInterface
{
    public function onMovieUnderageEventFirst(MovieUnderageEvent $event): void
    {
        // ...
    }

    public function onMovieUnderageEventSecond(MovieUnderageEvent $event): void
    {

    }

    public static function getSubscribedEvents(): array
    {
        return [
            MovieUnderageEvent::class => [
                ['onMovieUnderageEventFirst', 1000],
                ['onMovieUnderageEventSecond', 500],
            ],
        ];
    }
}
