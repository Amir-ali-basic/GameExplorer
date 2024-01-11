<?php

namespace App\Controller\Games;

use App\Service\Games\GamesApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $originalCategories = $this->gameApiService->getCategories();
        $popularGames = $this->gameApiService->getGamesByCategoryId(95);
        $providersData = [];

        $categoriesData = []; // Initialize an array to store category data (ID and Title)

        foreach ($gamesData as $game) {
            // Use methods from GameModel to access data
            $gameCategories = $game->getCats();
            $provider = $game->getProviderTitle();

            if ($provider && !in_array($provider, $providersData)) {
                $providersData[] = $provider;
            }

            if ($gameCategories) {
                foreach ($gameCategories as $category) {
                    if ($category['type'] === 'category') {
                        $categoryId = $category['id'];
                        if (in_array($categoryId, $originalCategories)) {
                            $categoryTitle = $category['title'];
                            $categoriesData[] = [
                                'id' => $categoryId,
                                'title' => $categoryTitle,
                            ];
                        }
                    }
                }
            }
        }

        // Remove duplicates from the array of category data (if any)
        $categoriesData = array_unique($categoriesData, SORT_REGULAR);

        return $this->render('pages/games/casino.html.twig', [
            'games' => $gamesData,
            'categories' => $categoriesData,
            'popularGames' => $popularGames,
            'providers' => $providersData,
        ]);
    }
    #[Route('/games/casino/loadGamesByCategory/{categoryId}', name: 'load_games_by_category')]
    public function loadGamesByCategory(GamesApiService $gameApiService, int $categoryId): JsonResponse
    {
        $gamesData = $gameApiService->getGamesByCategoryId($categoryId);

        $gamesArray = array_map(function ($game) {
            return $game->toArray();
        }, $gamesData);

        return new JsonResponse($gamesArray);
    }
}
