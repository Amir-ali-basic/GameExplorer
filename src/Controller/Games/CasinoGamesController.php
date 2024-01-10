<?php

namespace App\Controller\Games;

use App\Service\Games\GamesApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\Game;

class CasinoGamesController extends AbstractController
{
    private $gameApiService;

    public function __construct(GamesApiService $gameApiService)
    {
        $this->gameApiService = $gameApiService;
    }

    #[Route('/games/casino', name: 'casino_games')]
    public function index(): Response
    {
        $gamesData = $this->gameApiService->getGames();

        return $this->render('pages/games/casino.html.twig', [
            'games' => $gamesData,
        ]);
    }
}

// <?php

// namespace App\Controller\Games;

// use App\Service\Games\GamesApiService;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Component\Routing\Annotation\Route;

// class CasinoGamesController extends AbstractController
// {
//     private $gameApiService;

//     public function __construct(GamesApiService $gameApiService)
//     {
//         $this->gameApiService = $gameApiService;
//     }

//     #[Route('/games/casino', name: 'casino_games')]
//     public function index(): JsonResponse
//     {
//         $games = $this->gameApiService->getGames();

//         return $this->json($games);
//     }
// }

