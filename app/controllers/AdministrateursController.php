<?php

use Phalcon\Filter;

class AdministrateursController extends ControllerBase
{

    /**
     * Vérifie, accepte ou refuse la connexion d'un administrateur enregistré
     * @return mixed
     */
    public function postAdminsAction()
    {
        $admin = Administrateurs::find(
            [
                "login" => $this->request->getPost('login', Filter::FILTER_TRIM),
                "mdp" => md5($this->request->getPost('mdp', Filter::FILTER_TRIM))
            ]
        );

        if ($admin) {
            return $this->response([
                'erreurs' => [
                    'Type' => 'Erreur',
                    'Message' => 'Vous n\'êtes pas enregistrés'
                ]
            ]);
        }

        return $this->response([
            'success' => [
                'Type' => 'Reussite',
                'Message' => 'Vous êtes enregistrés'
            ]
        ]);
    }

}

