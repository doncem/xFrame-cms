<?php

namespace XframeCMS\Controller\Helper;

use XframeCMS\Model\Db\Page;

/**
 * Admin page helper to manage pages on the site.
 */
class PageHelper extends AbstractHelper
{
    /**
     * {@inheritdoc}
     */
    protected function getTemplateName()
    {
        return 'page';
    }

    /**
     * Retrieve list of packages used in this project.
     */
    protected function runAction()
    {
        if (isset($this->request->{'admin-web-title'})) {
            // $this->saveWebTitle();
        } else {
            $this->view->pages = $this->dic->em->getRepository(Page::class)->getAll();
        }
    }

    /**
     * Save page
     */
    private function savePage()
    {
    }
}
