<?php

use Phalcon\Dispatcher;
use Phalcon\Http\Response\StatusCode;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected $checkAuth = true;
    protected $contentType = 'application/json';

    public function response($response, $code = 200)
    {
        $this->response->setStatusCode($code, StatusCode::message($code));
        return json_encode($response);
    }

    public function afterExecuteRoute()
    {
        $this->response->setContentType($this->contentType, 'UTF-8');
    }

    public function beforeExecuteRoute()
    {
        if ($this->checkAuth) {
            $authorization = explode(' ', $this->request->getHeader('Authorization'));

            switch ($authorization[0]) {
                case 'Bearer':
                    if (JWTUtils::verifToken($authorization[1])) {
                        return true;
                    }
                    break;
                    
                case 'Basic':
                    $info = explode(':', base64_decode($authorization[1]));
                    /** @var Administrateurs $admin */
                    $admin = Administrateurs::findFirstByLogin($info[0]);
                    if ($admin && $this->security->checkHash($info[1], $admin->getMdp())) {
                        return true;
                    }
            }

            $this->response->setJsonContent(
                [
                    'status' => 'NOK'
                ]
            );

            return false;
        }
        return true;
    }
}
