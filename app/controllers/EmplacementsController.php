<?php

class EmplacementsController extends ControllerBase
{
    public function getEmplacementsNonOccupeAction()
    {
        return $this->response([
            'liste' => Emplacements::getEmplacementsNonOccupeToString()
        ]);
    }
}