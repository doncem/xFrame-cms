<?php

namespace XframeCMS;

use Xframe\Request\Controller;
use XframeCMS\Model\Db\Menu;
use XframeCMS\Model\Website;

/**
 * Abstract controller.
 */
class AbstractController extends Controller
{
    const WHITELISTED_RESOURCES = [
        'callback',
        'setup',
        'setup-verify',
        'setup-save'
    ];

    /**
     * Parse menu into usable array for template.
     */
    private function parseMenu(array $menus)
    {
        return $menus;
    }

    /**
     * Assign variables to view.
     */
    private function setupPostInit()
    {
        $this->view->menu = $this->parseMenu($this->dic->em->getRepository(Menu::class)->getActive());
        $this->view->isLive = $this->dic->isLive;
    }

    /**
     * Check setup is complete.
     */
    protected function init()
    {
        if (!$this->dic->registry->setup->IS_SET && !\in_array($this->request->getRequestedResource(), self::WHITELISTED_RESOURCES, true)) {
            $this->redirect('/setup');
        }

        if (!\in_array($this->request->getRequestedResource(), self::WHITELISTED_RESOURCES, true)) {
            $this->setupPostInit();
        }

        $this->view->resource = $this->request->getRequestedResource();
        $this->view->web = Website::getInstance($this->dic)->getWebData();
    }
}
