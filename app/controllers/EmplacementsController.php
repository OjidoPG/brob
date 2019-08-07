<?php

use Phalcon\Mvc\Controller;

class EmplacementsController extends Controller
{

    public function getEmplacementsAction()
    {
        $listeEmplacements = Emplacements::find("occupe = 0");
        return json_encode($listeEmplacements);
    }
}

