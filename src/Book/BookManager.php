<?php

namespace App\Book;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class BookManager
{
    public function __construct(
        protected readonly BookRepository $repository,
        #[Autowire('%items_per_page%')]
        protected readonly int $limit,
        protected readonly Security $security,
    )
    {
    }

    public function getBook(int $id): ?Book
    {
        return $this->repository->find($id);
    }

    public function findPaginated(int $page): iterable
    {
        return $this->repository->findBy(
            [],
            [],
            $this->limit,
            ($page - 1) * $this->limit
        );
    }

    public function doStuff():void
    {
        // ...
        if ($this->security->isGranted('ROLE_USER')) {
            // ...
        }
    }
}
