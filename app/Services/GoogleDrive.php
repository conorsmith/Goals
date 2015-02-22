<?php namespace ConorSmith\Goals\Services;

use Cache;
use Google_Client;
use Google_Service_Drive;

class GoogleDrive
{
    private $client;
    private $service;

    public function getClient()
    {
        if (is_null($this->client)) {
            $this->client = new Google_Client;
            $this->client->setAuthConfigFile(env('GOOGLE_API_SECRETS'));
            $this->client->addScope(Google_Service_Drive::DRIVE_READONLY);
            $this->client->setRedirectUri(env('GOOGLE_API_REDIRECT') . route('oauth', ['google'], false));
        }

        return $this->client;
    }

    public function getService()
    {
        if (is_null($this->service)) {
            $this->getClient();
            $this->client->setAccessToken(Cache::get('google.access_token'));
            $this->service = new Google_Service_Drive($this->client);
        }

        return $this->service;
    }

    public function hasAccessToken()
    {
        return Cache::has('google.access_token');
    }
}