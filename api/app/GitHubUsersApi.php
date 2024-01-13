<?php 
namespace App;

use GuzzleHttp\Client;

class GitHubUsersApi 
{
    private $guzzleHttpClient;

    public function __construct()
    {
        $this->guzzleHttpClient = new Client();
    }

    public function findUserByLogin(string $userLogin)
    {   
        return $this->get("users/$userLogin");
    }

    public function findRepositoriesByLogin(string $userLogin) 
    {   
        return $this->get("users/$userLogin/repos");
    }

    private function get(string $urlPath, array $params = [])
    {
        $response = $this->guzzleHttpClient->get("https://api.github.com/$urlPath", $params);
        $body = $response->getBody()->getContents();
        return $data = json_decode($body, true);
    }
}

