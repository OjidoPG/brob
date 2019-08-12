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
        $admin = Administrateurs::findFirstByLogin($this->request->getPost('login', Filter::FILTER_TRIM));

        if ($admin) {
            if ($admin->checkmdp($this->request->getPost('mdp', Filter::FILTER_TRIM))) {
                return $this->response([
                    'success' => [
                        'Type' => 'Reussite',
                        'Message' => 'Vous êtes enregistrés'
                    ]
                ]);
            }
        }

        return $this->response([
            'erreurs' => [
                'Type' => 'Erreur',
                'Message' => 'Vous n\'êtes pas enregistrés'
            ]
        ]);
    }

    public function genePassAction()
    {
        $this->security->hash($_POST['mdp']);
        die(var_dump($this->security->hash($_POST['mdp'])));
    }

}

