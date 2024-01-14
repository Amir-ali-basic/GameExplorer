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
                return $response->toArray(); // Return data directly
            }
            return "API Error with status code: " . $response->getStatusCode();
        } catch (\Exception $e) {
            return "Error fetching data: " . $e->getMessage();
        }
    }

    public function getGames()
    {
        $response = $this->fetchFromApi('/games');

        if (is_string($response)) { // Check if the response is an error message
            return ['error' => $response];
        }

        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $response);
    }

    public function getCategories()
    {
        $response = $this->fetchFromApi('/games/getUniqueCategoryIds');

        if (is_string($response)) {
            return ['error' => $response];
        }

        return $response;
    }

    public function getGamesByCategoryId($categoryId)
    {
        $response = $this->fetchFromApi('/games/getByCategoryId/' . $categoryId);

        if (is_string($response)) {
            return ['error' => $response];
        }

        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $response);
    }

    public function getGamesByProvider($provider)
    {
        $response = $this->fetchFromApi('/games/getByProvider?provider=' . urlencode($provider));

        if (is_string($response)) {
            return ['error' => $response];
        }

        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $response);
    }

    public function getGamesByName($name)
    {
        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $this->fetchFromApi('/games/getByName?name=' . urlencode($name)));
    }

    public function getGameById($id)
    {
        $response = $this->fetchFromApi('/game/' . urlencode($id));

        if (is_string($response)) {
            return ['error' => $response];
        }

        if (!empty($response)) {
            return new GameModel($response);
        } else {
            return ['error' => 'No game data found for ID: ' . $id];
        }
    }
}
