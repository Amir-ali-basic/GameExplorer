<?php

namespace App\Controller\Games;

use Symfony\Component\HttpFoundation\Request;
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
    //reorganize this function
    #[Route('/games/casino', name: 'casino_games')]
    public function index(): Response
    {
        $gamesData = $this->gameApiService->getGames();
        $originalCategories = $this->gameApiService->getCategories();
        $popularGames = $this->gameApiService->getGamesByCategoryId(95);
        $providersData = [];
        $gamesByCategory = [];
        $categoriesData = [];

        foreach ($gamesData as $game) {
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
                            $gamesByCategory[$categoryTitle][] = $game->toArray();
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
            'gamesByCategory' => $gamesByCategory,
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
    #[Route('/games/casino/search', name: 'search_casino_games')]
    public function searchGames(Request $request): JsonResponse
    {
        $searchTerm = $request->query->get('name', '');

        $gamesData = $this->gameApiService->getGamesByName($searchTerm);

        $gamesArray = array_map(function ($game) {
            return $game->toArray();
        }, $gamesData);

        return new JsonResponse($gamesArray);
    }
    #[Route('/games/casino/all', name: 'all_casino_games')]
    public function getAllGames(): JsonResponse
    {
        $gamesData = $this->gameApiService->getGames();

        $gamesArray = array_map(function ($game) {
            return $game->toArray();
        }, $gamesData);

        return new JsonResponse($gamesArray);
    }

    #[Route('/games/casino/loadGamesByProvider/{provider}', name: 'load_games_by_provider')]
    public function loadGamesByProvider(GamesApiService $gameApiService, string $provider): JsonResponse
    {
        $gamesData = $gameApiService->getGamesByProvider($provider);

        $gamesArray = array_map(function ($game) {
            return $game->toArray();
        }, $gamesData);

        return new JsonResponse($gamesArray);
    }

}
