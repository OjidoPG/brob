<?php

use Phalcon\Mvc\Controller;

class EmplacementsController extends Controller
{

    public function getEmplacementsAction()
    {
        $listeEmplacements = Emplacements::find();
        return json_encode($listeEmplacements);
    }
}

