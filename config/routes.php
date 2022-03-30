<?php

use Slim\App;

return function (App $app) {
    $app->post('/users', \App\Action\User\UserPostAction::class);
    $app->get('/users', \App\Action\User\UserGetAllAction::class);
};