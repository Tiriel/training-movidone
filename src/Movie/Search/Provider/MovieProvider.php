<?php

namespace App\Movie\Search\Provider;

use App\Entity\Movie;
use App\Movie\Search\Consumer\OmdbApiConsumer;
use App\Movie\Search\Enum\SearchType;
use App\Movie\Search\Transformer\OmdbMovieTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MovieProvider
{
    public function __construct(
        protected readonly EntityManagerInterface $manager,
        protected readonly OmdbApiConsumer $consumer,
        protected readonly OmdbMovieTransformer $transformer,
        protected readonly GenreProvider $genreProvider,
    )
    {
    }

    public function getOne(SearchType $type, string $value): ?Movie
    {
        $movie = $this->manager->getRepository(Movie::class)->findLikeOmdb($type, $value);

        if ($movie instanceof Movie) {
            return $movie;
        }

        try {
            $data = $this->consumer->fetchMovieData($type, $value);
        } catch (NotFoundHttpException) {
            return null;
        }

        $movie = $this->transformer->transform($data);
        foreach ($this->genreProvider->getFromOmdbString($data['Genre']) as $genre) {
            $movie->addGenre($genre);
        }

        $this->manager->persist($movie);
        $this->manager->flush();

        return $movie;
    }
}
