<?php

use Phalcon\Mvc\Controller;

class EmplacementsController extends Controller
{
    /**
     * Renvoit en json la liste des emplacements disponibles
     *
     * @return false|string
     */
    public function getEmplacementsAction()
    {
        $emplacementsDisponibles = Emplacements::find("occupe = 0 ");
        return json_encode($emplacementsDisponibles);
    }

}

