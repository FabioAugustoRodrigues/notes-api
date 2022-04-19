<?php

use Slim\App;

return function (App $app) {
    $app->post('/users', \App\Action\User\UserPostAction::class);
    $app->get('/users', \App\Action\User\UserGetAllAction::class);
    $app->get('/users/{id}', \App\Action\User\UserGetByIdAction::class);
    $app->patch('/users/{id}', \App\Action\User\UserPatchNameAndEmailAction::class);
    $app->delete('/users/{id}', \App\Action\User\UserDeleteAction::class);
};