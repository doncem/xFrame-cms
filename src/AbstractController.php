<?php

namespace XframeCMS;

use Xframe\Request\Controller;

class AbstractController extends Controller
{
    protected function init()
    {
        if (!$this->dic->registry->isSet) {
            $this->redirect('/setup');
        }
    }
}
