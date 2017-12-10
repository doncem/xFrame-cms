<?php

namespace XframeCMS;

use Xframe\Request\Controller;

class AbstractController extends Controller
{
    const WHITELISTED_RESOURCES = [
        'callback',
        'setup',
        'setup-verify',
        'setup-save'
    ];

    protected function init()
    {
        if (!$this->dic->registry->setup->IS_SET && !\in_array($this->request->getRequestedResource(), self::WHITELISTED_RESOURCES)) {
            $this->redirect('/setup');
        }

        $this->view->resource = $this->request->getRequestedResource();
    }
}
