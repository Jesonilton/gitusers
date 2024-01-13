<?php

require '__DIR__\\..\\vendor\\autoload.php';

use App\GitHubUsersApi;
// use App\GitHubUsersStorage;

// $s = new GitHubUsersStorage();
// $s->test();

$g = new GitHubUsersApi();

var_dump($g->findRepositoriesByLogin('wallysonn'));