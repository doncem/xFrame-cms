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

        $this->view->action = \strtolower($helper);
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
            case "my-profile":
                $helper = "Profile";

                break;
            default:
                break;
        }

        return "XframeCMS\\Controller\\Helper\\{$helper}Helper";
    }

    /**
     * Run request processor aka helper.
     *
     * @param string $helperClass
     * @param string $action
     */
    private function runHelper(string $helperClass, string $action)
    {
        /* @var $helper AbstractHelper */
        $helper = new $helperClass($this->dic, $this->request, $this->view, $action);

        $helper->run();
    }
}
