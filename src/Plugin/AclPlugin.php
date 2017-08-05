<?php

namespace XframeCMS\Plugin;

use Xframe\Authorisation\Acl;
use Xframe\Plugin\AbstractPlugin;

class AclPlugin extends AbstractPlugin
{
    const RESOURCE_SETUP = 'setup';

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    public function init()
    {
        $acl = new Acl();

        return $acl->addResource(self::RESOURCE_SETUP)
            ->addRole(self::ROLE_ADMIN)
            ->addRole(self::ROLE_USER)
            ->denyAll()
            ->allowRole(self::ROLE_ADMIN);
    }

}
