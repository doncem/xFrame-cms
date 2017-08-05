<?php

namespace XframeCMS;

use Xframe\Request\Controller;

class AbstractController extends Controller
{
    const WHITELISTED_RESOURCES = [
        'login',
        'register'
    ];

    protected function init()
    {
        if (!$this->dic->registry->isSet && !\in_array($this->request->getRequestedResource(), self::WHITELISTED_RESOURCES)) {
            $this->redirect('/setup');
        }
    }
}
