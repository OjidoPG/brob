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
        $login = $this->request->getPost('login', Filter::FILTER_TRIM);
        $mdp = $this->request->getPost('mdp', Filter::FILTER_TRIM);

        /** @var Administrateurs $admin */
        $admin = Administrateurs::findFirstByLogin($login);

        if ($admin) {
            if ($this->security->checkHash($mdp, $admin->getMdp())) {
                return $this->response([
                    'Success' => [
                        'Type' => 'Reussite',
                        'Message' => 'Vous êtes enregistré'
                    ]
                ]);
            }else{
                return $this->response([
                    'Incomplet' => [
                        'Type' => 'Incomplet',
                        'Message' => 'Login/Mot de passe invalide'
                    ]
                ]);
            }
        }

        return $this->response([
            'Erreurs' => [
                'Type' => 'Erreur',
                'Message' => 'Vous n\'êtes pas enregistré'
            ]
        ]);
    }

    /**
     * Méthode a utiliser avec postman pour générer un mot de passe valide
     */
    public function genePassAction()
    {
        $this->security->hash($_POST['mdp']);
        die(var_dump($this->security->hash($_POST['mdp'])));
    }

}

