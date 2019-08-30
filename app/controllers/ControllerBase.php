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

    public function afterExecuteRoute()
    {
        $this->response->setContentType($this->contentType, 'UTF-8');
    }

//    public function beforeExecuteRoute(){
//        $this->session->set('id', 1);
//        $this->session->destroy();
//        if ($this->session->has('id')){
//            return true;
//        }
//        return false;
//    }
}
