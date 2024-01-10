<?php

namespace App\Entity\Games;

class Game
{
    private $categories;
    private $features;
    private $themes;
    private $icons;
    private $backgrounds;
    private $id;
    private $serverGameId;
    private $externalGameId;
    private $frontGameId;
    private $name;
    private $title;
    private $ratio;
    private $status;
    private $provider;
    private $showAsProvider;
    private $providerTitle;
    private $gameOptions;
    private $blockedCountries;
    private $hasAgeRestriction;
    private $icon2;
    private $background;
    private $types;
    private $gameSkinId;
    private $cats;
    private $feats;
    private $thms;
    private $active;

    public function __construct(
        $game
    ) {
        $this->categories = $game->getCategories();
        $this->features = $game->getFeatures();
        $this->themes = $game->getThemes();
        $this->icons = $game->getIcons();
        $this->backgrounds = $game->getBackgrounds();
        $this->id = $game->getId();
        $this->serverGameId = $game->getServerGameId();
        $this->externalGameId = $game->getExternalGameId();
        $this->frontGameId = $game->getFrontGameId();
        $this->name = $game->getName();
        $this->title = $game->getTitle();
        $this->ratio = $game->getRatio();
        $this->status = $game->getStatus();
        $this->provider = $game->getProvider();
        $this->showAsProvider = $game->getShowAsProvider();
        $this->providerTitle = $game->getProviderTitle();
        $this->gameOptions = $game->getGameOptions();
        $this->blockedCountries = $game->getBlockedCountries();
        $this->hasAgeRestriction = $game->getHasAgeRestriction();
        $this->icon2 = $game->getIcon2();
        $this->background = $game->getBackground();
        $this->types = $game->getTypes();
        $this->gameSkinId = $game->getGameSkinId();
        $this->cats = $game->getCats();
        $this->feats = $game->getFeats();
        $this->thms = $game->getThms();
        $this->active = $game->getActive();
    }
    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getFeatures(): array
    {
        return $this->features;
    }

    public function getThemes(): array
    {
        return $this->themes;
    }

    public function getIcons(): array
    {
        return $this->icons;
    }

    public function getBackgrounds(): array
    {
        return $this->backgrounds;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getServerGameId()
    {
        return $this->serverGameId;
    }

    public function getExternalGameId()
    {
        return $this->externalGameId;
    }

    public function getFrontGameId()
    {
        return $this->frontGameId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getRatio()
    {
        return $this->ratio;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getProvider()
    {
        return $this->provider;
    }

    public function getShowAsProvider()
    {
        return $this->showAsProvider;
    }

    public function getProviderTitle()
    {
        return $this->providerTitle;
    }

    public function getGameOptions()
    {
        return $this->gameOptions;
    }

    public function getBlockedCountries()
    {
        return $this->blockedCountries;
    }

    public function getHasAgeRestriction()
    {
        return $this->hasAgeRestriction;
    }

    public function getIcon2()
    {
        return $this->icon2;
    }

    public function getBackground()
    {
        return $this->background;
    }

    public function getTypes()
    {
        return $this->types;
    }

    public function getGameSkinId()
    {
        return $this->gameSkinId;
    }

    public function getCats()
    {
        return $this->cats;
    }

    public function getFeats()
    {
        return $this->feats;
    }

    public function getThms()
    {
        return $this->thms;
    }

    public function getActive()
    {
        return $this->active;
    }

}
