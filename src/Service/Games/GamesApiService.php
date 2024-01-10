<?php
namespace App\Service\Games;

use App\Model\GameModel;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Games\Game;


class GamesApiService
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create();
    }

    public function getGames()
    {
        $url = 'https://casino-games-api.united-remote.dev/games';
        $response = $this->httpClient->request('GET', $url);

        if ($response->getStatusCode() === 200) {
            $gamesData = $response->toArray();

            $games = [];
            foreach ($gamesData as $gameData) {
                $game = new GameModel($gameData);
                $games[] = $game;
            }

            return $games;
        }

        return []; // Obradite grešku ili vratite prazan niz
    }
}