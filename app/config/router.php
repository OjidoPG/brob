<?php

use Phalcon\Mvc\Router;

//$router->add('/:controller', [
//    'controller' => 1
//]);
//
//$router->add('/:controller/:action', [
//    'controller' => 1,
//    'action' => 2
//]);
//
//$router->add('/:controller/:action/:params', [
//    'controller' => 1,
//    'action' => 2,
//    'params' => 3
//]);

$di->set('router', new Router);


