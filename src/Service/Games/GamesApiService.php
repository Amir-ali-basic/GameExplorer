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
        }, $this->fetchFromApi('/games'));
    }

    public function getCategories()
    {
        return $this->fetchFromApi('/games/getUniqueCategoryIds');
    }

    public function getGamesByCategoryId($categoryId)
    {
        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $this->fetchFromApi('/games/getByCategoryId/' . $categoryId));
    }

    public function getGamesByProvider($provider)
    {
        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $this->fetchFromApi('/games/getByProvider?provider=' . urlencode($provider)));
    }
    public function getGamesByName($name)
    {
        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $this->fetchFromApi('/games/getByName?name=' . urlencode($name)));


    }
    public function getGameById($id)
    {
        $gameData = $this->fetchFromApi('/game/' . urlencode($id));

        return new GameModel($gameData);
    }
}
