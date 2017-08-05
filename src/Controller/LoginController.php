<?php

namespace XframeCMS\Controller;

use XframeCMS\AbstractController;

final class LoginController extends AbstractController
{
    private function setView()
    {
        $this->view->type = $this->request->getRequestedResource();
    }

    /**
     * @Request login
     */
    public function index()
    {
        $this->setView();
    }

    /**
     * @Request register
     * @Template login
     */
    public function register()
    {
        $this->setView();
    }
}
