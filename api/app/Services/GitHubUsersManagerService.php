<?php 

namespace App\Services;

use App\GitHubUsersApi;
use App\Models\GitHubUser;
use App\GitHubUsersStorage;
use App\Traits\FeedbackMessages;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserAlreadyExistsException;

class GitHubUsersManagerService {

    use FeedbackMessages;

    /**
     * @var \App\GitHubUsersStorage
     */
    private $storage;
    /**
     * @var \App\GitHubUsersApi
     */
    private $gitHubUsersApi;
    
    //Poderia usar interface, mas para facilitar a leitura decidi criar logo a instancia
    public function __construct(/** GitHubUsersStorageInterface $storage */)
    {
        $this->storage = new GitHubUsersStorage();
        $this->gitHubUsersApi = new GitHubUsersApi();
    }

    public function findUser($userLogin)
    {
        try {
            $this->storage->findUser($userLogin);

            return $this->success("Ok", $this->storage->findUser($userLogin));
        } catch (UserNotFoundException $e) {
            throw $e;
        } catch (\Exception $e) {
            return $this->error("Server Error");
        } 
    }

    public function getUsers()
    {
        try {
            return $this->success("Ok", $this->storage->getUsers());
        } catch (\Exception $e) {
            return $this->error("Server Error");
        } 
    }

    public function importUser($userLogin)
    {
        try {
            $user = $this->gitHubUsersApi->findUserByLogin($userLogin);
            
            if(!$user) {
                throw new UserNotFoundException('Usuário não encontrado');
            }

            $gitUser = new GitHubUser($user['id'], $user['name'], $user['login'], $user['avatar_url'], $user['public_repos'], $user['followers'], $user['following'], $user['created_at']);
            $this->storage->addUser($gitUser);

            return $this->success("Importado com sucesso", $gitUser);
        } catch (UserAlreadyExistsException $e) {
            throw $e;
        } catch (\Exception $e) {
            return $this->error("Server Error");
        } 
    }

    public function deleteUser($userLogin)
    {
        try {
            $this->storage->removeUser($userLogin);

            return $this->success("Removido com sucesso");
        } catch (UserNotFoundException $e) {
            throw $e;
        } catch (\Exception $e) {
            return $this->error("Server Error");
        } 
    }
}