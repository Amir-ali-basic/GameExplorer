<?php
namespace App\Service\Games;

use App\Model\GameModel;
use Symfony\Component\HttpClient\HttpClient;
use App\Exception\ApiException;
use App\Constants;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;

class GamesApiService
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create();
    }

    private function fetchFromApi($endpoint)
    {
        try {
            $response = $this->httpClient->request('GET', Constants::BASE_URL . $endpoint);
            if ($response->getStatusCode() === 200) {
                return $response->toArray();
            }
            throw new ApiException("API Error with status code: " . $response->getStatusCode(), $response->getStatusCode());
        } catch (\Exception $e) {
            throw new ApiException("Error fetching data: " . $e->getMessage());
        }
    }


    public function getGames()
    {
        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $this->fetchFromApi('/'));
    }

    public function getCategories()
    {
        return $this->fetchFromApi('/getUniqueCategoryIds');
    }

    public function getGamesByCategoryId($categoryId)
    {
        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $this->fetchFromApi('/getByCategoryId/' . $categoryId));
    }

    public function getGamesByProvider($provider)
    {
        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $this->fetchFromApi('/getByProvider?provider=' . urlencode($provider)));
    }
    public function getGamesByName($name)
    {
        $url = 'https://casino-games-api.united-remote.dev/games/getByName?name=' . urlencode($name);
        $response = $this->httpClient->request('GET', $url);
        //error need to be handled when there is no data
        if ($response->getStatusCode() === 200) {
            $gamesData = $response->toArray();

            $games = [];
            foreach ($gamesData as $gameData) {
                $game = new GameModel($gameData);
                $games[] = $game;
            }

            return $games;
        }

        return [];

    }
    public function getGameById($id)
    {
        $url = 'https://casino-games-api.united-remote.dev/game/' . urlencode($id);
        $response = $this->httpClient->request('GET', $url);

        if ($response->getStatusCode() === 200) {
            $gameData = $response->toArray();

            if (!empty($gameData)) {
                $game = new GameModel($gameData);
                return $game;
            } else {

                throw new \Exception('No game data found for ID: ' . $id);
            }
        } else {
            throw new \Exception('Failed to fetch game data for ID: ' . $id);
        }
    }

}
