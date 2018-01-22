<?php

namespace XframeCMS\Controller;

use XframeCMS\AbstractController;
use XframeCMS\Controller\Helper\AbstractHelper;

/**
 * Description of Index
 * @package admin_controllers
 */
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
        $action = $this->request->action;
        $helper = "";

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
    }

    /**
     * Run request processor aka helper.
     *
     * @param string $helper
     * @param string $action
     */
    private function runHelper($helper, $action)
    {
        if (\mb_strlen($helper) > 0) {
            $classname = "XframeCMS\\Controller\\Helper\\{$helper}Helper";
            /* @var $helper AbstractHelper */
            $helper = new $classname($this->dic, $action);
            $helper->setRequest($this->request);

            $result = $helper->process();

            $this->view->setTemplate($this->package . $helper->getTemplateName());
        }
    }
}
