<?php

class EmplacementsController extends ControllerBase
{
    public function getEmplacementsAction()
    {
        return $this->response([
            'liste' => Emplacements::getEmplacementsNonOccupeToString()
        ]);
    }
}