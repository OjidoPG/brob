<?php

use Phalcon\Dispatcher;
use Phalcon\Http\Response\StatusCode;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected $contentType = 'application/json';

    public function response($response, $code = 200)
    {
        $this->response->setStatusCode($code, StatusCode::message($code));
        return json_encode($response);
    }

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $controllerName = $dispatcher->getControllerName();
        $actionName = $dispatcher->getActionName();
        $identity = $this->auth->getIdentity();

        if (!$this->acl->isAllowed($identity['profile'], $controllerName, $actionName)) {
            $this->flash->notice('You don\'t have access to this module: ' . $controllerName . ':' . $actionName);
            if ($this->acl->isAllowed($identity['profile'], $controllerName, 'index')) {
                $dispatcher->forward([
                    'controller' => $controllerName,
                    'action' => 'index'
                ]);
            } else {
                $dispatcher->forward([
                    'controller' => 'user_control',
                    'action' => 'index'
                ]);
            }
            return false;
        }
    }

    public function afterExecuteRoute()
    {
        $this->response->setContentType($this->contentType, 'UTF-8');
    }
}
