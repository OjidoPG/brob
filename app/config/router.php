<?php

$router = $di->getRouter();

$router->addGet(
    '/api/getClients',
    [
        'controller' => 'clients',
        'action' => 'getClients'
    ]
);

$router->addPost(
    '/api/postClients',
    [
        'controller' => 'clients',
        'action' => 'postClients'
    ]
);

$router->addGet(
    '/api/getEmplacements',
    [
        'controller' => 'emplacements',
        'action' => 'getEmplacements'
    ]
);

$router->addPost(
    '/api/postAdmins',
    [
        'controller' => 'administrateurs',
        'action' => 'postAdmins'
    ]
);

$router->handle();

