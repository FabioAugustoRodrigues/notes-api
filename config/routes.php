<?php

use Slim\App;

return function (App $app) {
    $app->post('/users', \App\Action\User\UserPostAction::class);
    $app->get('/users', \App\Action\User\UserGetAllAction::class);
    $app->get('/users/{id}', \App\Action\User\UserGetByIdAction::class);
    $app->patch('/users/{id}', \App\Action\User\UserPatchNameAndEmailAction::class);
    $app->delete('/users/{id}', \App\Action\User\UserDeleteAction::class);
    $app->post('/login', \App\Action\User\UserLoginAction::class);

    $app->post('/notes', \App\Action\Note\NotePostAction::class);
    $app->get('/notes/{id}', \App\Action\Note\NoteGetByIdAction::class);
    $app->get('/notes/user/{id}', \App\Action\Note\NoteGetAllByUserAction::class);
};