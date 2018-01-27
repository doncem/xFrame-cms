<?php

namespace XframeCMS\Controller;

use XframeCMS\AbstractController;
use XframeCMS\Controller\Helper\AbstractHelper;

class AdminController extends AbstractController
{
    /**
     * Homepage landing page.
     *
     * @Request admin
     * @Parameter -> ["action", "\\Xframe\\Validation\\Regex('/(\\S+|^$)/')", false]
     * @Template "admin/index"
     */
    public function admin()
    {
        $action = $this->request->action || "";
        $helper = "Index";

        switch ($action) {
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

        $this->runHelper($helper, $action);
        $this->view->action = \strtolower($helper);
    }

    /**
     * Run request processor aka helper.
     *
     * @param string $helper
     * @param string $action
     */
    private function runHelper(string $helper, string $action)
    {
        if (\mb_strlen($helper) > 0) {
            $classname = "XframeCMS\\Controller\\Helper\\{$helper}Helper";
            /* @var $helper AbstractHelper */
            $helper = new $classname($this->dic, $this->request, $this->view, $action);

            $helper->process();
        }
    }
}
