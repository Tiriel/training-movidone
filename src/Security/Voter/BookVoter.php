<?php

namespace App\Security\Voter;

use App\Entity\Book;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use function PHPUnit\Framework\assertInstanceOf;

class BookVoter extends Voter
{
    public const IS_CREATOR = 'book.is_creator';

    public function __construct(protected readonly AuthorizationCheckerInterface $checker)
    {
    }

    protected function supports(string $attribute, mixed $subject): bool // true = voir voteOnAttribute, false = ACCESS_ABSTAIN
    {
        return $subject instanceof Book
            && \in_array($attribute, [self::IS_CREATOR]);
    }

    /**
     * @param Book $subject
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool // true = ACCESS_GRANTED, false = ACCESS_DENIED
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return $this->checker->isGranted('ROLE_ADMIN');
        }
        // assert($subject instanceof Book);

        return match ($attribute) {
            self::IS_CREATOR => $user === $subject->getCreatedBy(),
            default => false,
        };
    }
}
