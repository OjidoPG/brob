<?php

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;

/**
 * Gère les accès aux différentes parties de l'application
 * Class Acl
 */
class Acl extends ControllerBase
{
    public static function getAcl()
    {
        $acl = new AclList();

        $acl->setDefaultAction(Acl::DENY);

        $roleAdmininistrateurs = new Role('RoleAdministrateurs');
        $roleClients = new Role('RoleClients');

        $acl->addRole($roleAdmininistrateurs);
        $acl->addRole($roleClients);

        $adminResource = new Resource('Administrateurs');
        $acl->addResource(
            $adminResource,'postAdmins'
        );

//        $acl->allow('RoleAdministrateurs', 'Administrateurs','postAdmins');
//        $acl->deny('RoleClients', 'Administrateurs','postAdmins');

    }
}
