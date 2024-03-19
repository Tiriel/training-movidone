<?php

namespace App\Movie\Notifier;

use App\Entity\Movie;
use App\Entity\User;
use App\Movie\Notifier\Factory\NotificationFactoryInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;

class MovieNotifier
{
    public function __construct(
        protected readonly NotifierInterface $notifier,
        /** @var NotificationFactoryInterface[] $factories */
        #[TaggedIterator('app.notification_factory', defaultIndexMethod: 'getIndex')]
        protected iterable $factories,
    )
    {
        $this->factories = $factories instanceof \Traversable ? iterator_to_array($factories) : $factories;
        // ['slack' => new SlackNotificationFactory(), 'discord' => new DiscordNotificationFactory()]
    }

    public function sendNewMovieNotification(User $user, Movie $movie): void
    {
        $subject = sprintf("The movie %s has been added to our database", $movie->getTitle());
        $notification = $this->factories[$user->getPreferredChannel()]->createNotification($subject);

        $this->notifier->send($notification, new Recipient($user->getEmail()));
    }
}
