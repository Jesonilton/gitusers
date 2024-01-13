<?php 
namespace App;

use App\Models\GitHubUser;
use App\Exceptions\UserNotFoundException;
use App\Interfaces\GitHubUserModelInterface;
use App\Exceptions\UserAlreadyExistsException;

class GitHubUsersStorage {

    private $users;

    public function __construct() 
    {
        $this->filePath = __DIR__."/../storage".DIRECTORY_SEPARATOR."githubusers.json";
        $this->users = $this->readUsers();
    }

    private function readUsers() 
    {
        if (file_exists($this->filePath)) {
            $users = json_decode(file_get_contents($this->filePath), true);
            return is_array($users) && count($users) ? $users : [];
        } else {
            return null;
        }
    }

    public function getUsers() 
    {
        return $this->users;
    }

    public function findUser(string $userLogin) 
    {
        foreach ($this->users as $key => $user) {
            if($user['login'] == $userLogin) {
                return $user;
            }
        }
        
        return null;
    }

    public function addUser(GitHubUserModelInterface $user) 
    {
        if($this->findUser($user->login)) {
            throw new UserAlreadyExistsException("User already exists", 1);
        }

        $this->users[] = $user->toArray();

        $this->updateStorage();
    }

    public function removeUser(string $userLogin) {
        if(!$this->findUser($userLogin)) {
            throw new UserNotFoundException("User not found", 1);
        }

        $this->users = array_values(array_filter($this->users, function($user) use($userLogin){
            return $user['login'] != $userLogin;
        }));

        $this->updateStorage();
    }

    private function updateStorage()
    {
        file_put_contents($this->filePath, json_encode($this->users, JSON_PRETTY_PRINT), );
    }
}

