<?php 

namespace App\Controllers;

use Pecee\Http\Request;
use App\Exceptions\UserNotFoundException;
use App\Services\GitHubUsersManagerService;
use App\Exceptions\UserAlreadyExistsException;

class GithubUsersController {

    /**
     * @var \App\Services\GitHubUsersManagerService
     */
    private $gitHubUsersManagerService; 
    
    public function __construct()
    {
        $this->gitHubUsersManagerService = new GitHubUsersManagerService();
    }

    /**
     * @throws \Pecee\Exceptions\InvalidArgumentException
     */
    public function show($userLogin): void
	{
        try {
            $this->sendResponse($this->gitHubUsersManagerService->findUser($userLogin));
        } catch (UserNotFoundException $e) {
            response()->httpCode(200)->json(['success' => false, 'data' => [], 'message' => 'Usuário não encontrado']);
        }
	}

    public function index(): void
    {
        $this->sendResponse($this->gitHubUsersManagerService->getUsers());
    }

    public function store(): void
    {
        if(!input('user_login')) {
            response()->httpCode(400)->json(['success' => false, 'data' => [], 'message' => 'user_login é obrigatório']);
        }

        try {
            $this->sendResponse($this->gitHubUsersManagerService->importUser(input('user_login')));
        } catch (UserNotFoundException $e) {
            response()->httpCode(200)->json(['success' => false, 'data' => [], 'message' => 'Usuário não encontrado']);
        } catch (UserAlreadyExistsException $e) {
            response()->httpCode(200 )->json(['success' => false, 'data' => [], 'message' => 'Usuário já importado']);
        }
    }
    
    public function delete($userLogin): void
    {
        try {
            $this->sendResponse($this->gitHubUsersManagerService->deleteUser($userLogin));
        } catch (UserNotFoundException $e) {
            response()->httpCode(200)->json(['success' => false, 'data' => [], 'message' => 'Usuário não encontrado']);
        }
    }

    private function sendResponse($return)
    {
        if($return->success) {
            response()->httpCode(200)->json((array)$return);
        }

        response()->httpCode(500)->json((array)$return);
    }
}