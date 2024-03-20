<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AsController]
class SongController
{
    #[IsGranted('ROLE_SONG')]
    #[Route('/song', name: 'app_song_index')]
    public function __invoke()
    {
        return new Response('Yay');
    }
}
