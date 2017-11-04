<?php

namespace XframeCMS;

use Xframe\Request\Controller;

class AbstractController extends Controller
{
    const WHITELISTED_RESOURCES = [
        'callback',
        'setup'
    ];

    protected function init()
    {
        if (!$this->dic->registry->setup->IS_SET && !\in_array($this->request->getRequestedResource(), self::WHITELISTED_RESOURCES)) {
            $this->redirect('/setup');
        }
    }
}
