<?php

$router = $di->getRouter();

$router->addGet(
    '/api/getClients',
    [
        'controller' => 'clients',
        'action' => 'getClients'
    ]
);

$router->addGet(
    '/api/getAllClients',
    [
        'controller' => 'clients',
        'action' => 'getAllClients'
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

$router->addPost(
    '/api/genePass',
    [
        'controller' => 'administrateurs',
        'action' => 'genePass'
    ]
);

$router->handle();

