<?php

namespace XframeCMS\Prefilter;

use Xframe\Request\Controller;
use Xframe\Request\Prefilter;
use Xframe\Request\Request;

class AclPrefilter extends Prefilter
{
    public function run(Request $request, Controller $controller)
    {
        $acl = $this->dic->plugin->acl;
        $session = $this->dic->plugin->session;

        if ($acl->isAllowed($session, $request->getRequestedResource())) {
            return true;
        }

        $controller->redirect('/login?return=' . $request->getRequestedResource());
    }

}
