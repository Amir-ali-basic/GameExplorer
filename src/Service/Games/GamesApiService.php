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
            //THIS IS JUST FOR DEMONSTRATING PURPOSES, THIS DATA WE CAN TUSE FROM USER/TOKEN
            $userCountry = 'Mne';

            // Fetch data from the API
            $response = $this->httpClient->request('GET', Constants::BASE_URL . $endpoint);
            if ($response->getStatusCode() === 200) {
                $responseData = $response->toArray();

                // Filter out games that are blocked in the user's country
                $filteredResponse = $this->filterGamesByCountry($responseData, $userCountry);

                return $filteredResponse;
            }

            $errorMessage = ApiException::getErrorMessage($response->getStatusCode());
            throw new ApiException($errorMessage, $response->getStatusCode());
        } catch (\Exception $e) {
            return "Error fetching data: " . $e->getMessage();
        }
    }

    private function filterGamesByCountry($games, $userCountry)
    {
        // Create an array to store games that are not blocked in the user's country
        $filteredGames = [];

        foreach ($games as $game) {
            // Check if the game has a "blocked_countries" array
            if (isset($game['blocked_countries']) && is_array($game['blocked_countries'])) {
                // Check if the user's country is in the blocked countries
                if (!in_array($userCountry, $game['blocked_countries'])) {
                    // If not blocked, add the game to the filtered array
                    $filteredGames[] = $game;
                }
            } else {
                // If the game doesn't have blocked_countries, consider it not blocked
                $filteredGames[] = $game;
            }
        }

        return $filteredGames;
    }

    public function getGames()
    {
        $response = $this->fetchFromApi('/games');

        if (is_string($response)) {
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
            dd($response);
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
        $response = $this->fetchFromApi('/games/getByName?name=' . urlencode($name));

        if (is_string($response)) {
            dd($response);
            return ['error' => $response];
        }

        return array_map(function ($gameData) {
            return new GameModel($gameData);
        }, $response);
    }

    public function getGameById($id)
    {
        $response = $this->fetchFromApi('/game/' . urlencode($id));

        if (is_string($response)) {
            return ['error' => $response];
        }

        return new GameModel($response);
    }
}
