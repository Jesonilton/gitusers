<?php
use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Request;

\Pecee\SimpleRouter\SimpleRouter::setDefaultNamespace('App\\Controllers');



SimpleRouter::group(['prefix' => '/api'], function () {
    SimpleRouter::group(['prefix' => '/github-users'], function () {
        SimpleRouter::get('/', 'GithubUsersController@index');
        SimpleRouter::post('/', 'GithubUsersController@store');
        SimpleRouter::delete('/{user_login}', 'GithubUsersController@delete');
        SimpleRouter::get('/{user_login}', 'GithubUsersController@show');
    });
});

SimpleRouter::error(function(Request $request, \Exception $exception) {
    switch($exception->getCode()) {
        // Page not found
        case 404:
            response()->json(['status' => 404, 'message' => 'Not Found']);
        // Forbidden
        case 403:
            response()->json(['status' => 403, 'message' => 'Forbidden']);
    }
});