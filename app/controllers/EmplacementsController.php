<?php

class EmplacementsController extends ControllerBase
{

    public function getEmplacementsAction()
    {
        $listeEmplacements = Emplacements::find("occupe = 0");
        return $this->response([
            'liste' => $listeEmplacements
        ]);
    }
}

