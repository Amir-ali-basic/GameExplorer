<?php

namespace App\Model;

class GameModel
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
        array $data
    ) {
        $this->categories = isset($data['categories']) ? $data['categories'] : null;
        $this->features = isset($data['features']) ? $data['features'] : null;
        $this->themes = isset($data['themes']) ? $data['themes'] : null;
        $this->icons = isset($data['icons']) ? $data['icons'] : null;
        $this->backgrounds = isset($data['backgrounds']) ? $data['backgrounds'] : null;
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->serverGameId = isset($data['server_game_id']) ? $data['server_game_id'] : null;
        $this->externalGameId = isset($data['extearnal_game_id']) ? $data['extearnal_game_id'] : null;
        $this->frontGameId = isset($data['front_game_id']) ? $data['front_game_id'] : null;
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->title = isset($data['title']) ? $data['title'] : null;
        $this->ratio = isset($data['ratio']) ? $data['ratio'] : null;
        $this->status = isset($data['status']) ? $data['status'] : null;
        $this->provider = isset($data['provider']) ? $data['provider'] : null;
        $this->showAsProvider = isset($data['show_as_provider']) ? $data['show_as_provider'] : null;
        $this->providerTitle = isset($data['provider_title']) ? $data['provider_title'] : null;
        $this->gameOptions = isset($data['game_options']) ? $data['game_options'] : null;
        $this->blockedCountries = isset($data['blocked_countries']) ? $data['blocked_countries'] : null;
        $this->hasAgeRestriction = isset($data['has_age_restriction']) ? $data['has_age_restriction'] : null;
        $this->icon2 = isset($data['icon_2']) ? $data['icon_2'] : null;
        $this->background = isset($data['background']) ? $data['background'] : null;
        $this->types = isset($data['types']) ? $data['types'] : null;
        $this->gameSkinId = isset($data['game_skin_id']) ? $data['game_skin_id'] : null;
        $this->cats = isset($data['cats']) ? $data['cats'] : [];
        $this->feats = isset($data['feats']) ? $data['feats'] : null;
        $this->thms = isset($data['thms']) ? $data['thms'] : null;
        $this->active = isset($data['active']) ? $data['active'] : null;
    }
    public function getCategories()
    {
        return $this->categories;
    }

    public function getFeatures()
    {
        return $this->features;
    }

    public function getThemes()
    {
        return $this->themes;
    }

    public function getIcons()
    {
        return $this->icons;
    }

    public function getBackgrounds()
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
    public function toArray()
    {
        return [
            'categories' => $this->getCategories(),
            'features' => $this->getFeatures(),
            'themes' => $this->getThemes(),
            'icons' => $this->getIcons(),
            'backgrounds' => $this->getBackgrounds(),
            'id' => $this->getId(),
            'serverGameId' => $this->getServerGameId(),
            'externalGameId' => $this->getExternalGameId(),
            'frontGameId' => $this->getFrontGameId(),
            'name' => $this->getName(),
            'title' => $this->getTitle(),
            'ratio' => $this->getRatio(),
            'status' => $this->getStatus(),
            'provider' => $this->getProvider(),
            'showAsProvider' => $this->getShowAsProvider(),
            'providerTitle' => $this->getProviderTitle(),
            'gameOptions' => $this->getGameOptions(),
            'blockedCountries' => $this->getBlockedCountries(),
            'hasAgeRestriction' => $this->getHasAgeRestriction(),
            'icon2' => $this->getIcon2(),
            'background' => $this->getBackground(),
            'types' => $this->getTypes(),
            'gameSkinId' => $this->getGameSkinId(),
            'cats' => $this->getCats(),
            'feats' => $this->getFeats(),
            'thms' => $this->getThms(),
            'active' => $this->getActive()
        ];
    }

}
