<?php

namespace XframeCMS\Controller;

use Auth0\SDK\Exception\ApiException;
use XframeCMS\AbstractController;

/**
 * Controller for logging in and out actions.
 */
final class LoginController extends AbstractController
{
    /**
     * Set variables to the view.
     */
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

    /**
     * @Request callback
     */
    public function callback()
    {
        \setcookie('auth0state', $this->request->state);

        if (isset($this->request->error)) {
            $this->view->error = $this->request->error;
            $this->view->description = $this->request->error_description;
        } elseif (isset($this->request->code)) {
            \setcookie('auth0code', $this->request->code);

            $this->redirect('/');
        } else {
            throw new ApiException('Auth0 API error');
        }
    }
}
