<?php

namespace App\Models;

use App\Interfaces\GitHubUserModelInterface;

class GitHubUser implements GitHubUserModelInterface{
    
    public string $id;
    public string $name;
    public string $login;
    public string $avatar_url;
    public string $total_repositories;
    public string $total_followers;
    public string $total_following;
    public string $created_at;

    public function __construct($id, $name, $login, $avatar_url, $total_repositories, $total_followers, $total_following, $created_at) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->login = $login;
        $this->avatar_url = $avatar_url;
        $this->total_repositories = $total_repositories;
        $this->total_followers = $total_followers;
        $this->total_following = $total_following;
        $this->created_at = $created_at;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}