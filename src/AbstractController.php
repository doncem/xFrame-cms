<?php

namespace XframeCMS;

use Xframe\Request\Controller;
use XframeCMS\Model\Db\Menu;
use XframeCMS\Model\Website;

class AbstractController extends Controller
{
    const WHITELISTED_RESOURCES = [
        'callback',
        'setup',
        'setup-verify',
        'setup-save'
    ];

    private function parseMenu(array $menus)
    {
        return $menus;
    }

    private function setupPostInit()
    {
        $this->view->menu = $this->parseMenu($this->dic->em->getRepository(Menu::class)->getActive());
        $this->view->isLive = $this->dic->isLive;
    }

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
