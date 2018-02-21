<?php

namespace XframeCMS\Controller;

use XframeCMS\AbstractController;
use XframeCMS\Controller\Helper\AbstractHelper;

/**
 * Controller for admin actions.
 */
class AdminController extends AbstractController
{
    /**
     * @Request admin
     * @Parameter -> ["action", "\\Xframe\\Validation\\Regex('/(\\S+|^$)/')", false, ""]
     * @Template "admin/index"
     */
    public function admin()
    {
        $helper = $this->getHelperClass();
        $this->runHelper($helper, $this->request->action);

        $this->view->menuItem = \strtolower($helper);
        $this->view->action = $this->request->action;
    }

    /**
     * @Request admin-save
     * @Parameter -> ["action", "\\Xframe\\Validation\\Regex('/(\\S+|^$)/')", false, ""]
     * @View \Xframe\View\JsonView
     */
    public function adminSave()
    {
        $helper = $this->getHelperClass();
        $this->runHelper($helper, $this->request->action);
    }

    /**
     * @return string Helper class
     */
    private function getHelperClass()
    {
        $helper = "Index";

        switch ($this->request->action) {
            case "logout":
            case "login":
                $helper = "Auth";

                break;
            case "page":
                $helper = "Page";

                break;
            default:
                break;
        }

        return $helper;
    }

    /**
     * Run request processor aka helper.
     *
     * @param string $helperClass
     * @param string $action
     */
    private function runHelper(string $helper, string $action)
    {
        $helperClass = "XframeCMS\\Controller\\Helper\\{$helper}Helper";
        /* @var $helper AbstractHelper */
        $abstractHelper = new $helperClass($this->dic, $this->request, $this->view, $action);

        $abstractHelper->run();
    }
}
