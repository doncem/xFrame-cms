<?php

namespace XframeCMS\Controller\Helper;

use XframeCMS\Model\Db\Page;
use XframeCMS\Model\DB\PageUpdateLog;

/**
 * Admin page helper to manage pages on the site.
 */
class PageHelper extends AbstractHelper
{
    /**
     * Subpackaging everything under page/
     *
     * @var string
     */
    private $templateName;

    /**
     * {@inheritdoc}
     */
    protected function getTemplateName()
    {
        return 'page' . DIRECTORY_SEPARATOR . $this->templateName;
    }

    /**
     * Retrieve list of packages used in this project.
     */
    protected function runAction()
    {
        $this->setTemplateName();

        if (isset($this->request->{'admin-web-title'})) {
            // $this->saveWebTitle();
        } else {
            if ('index' === $this->templateName) {
                $this->view->pages = $this->dic->em->getRepository(Page::class)->getAll();
            } else {
                $this->view->page = $this->dic->em->getRepository(Page::class)->getPageById($this->request->identifier);
                $this->view->pageUpdateLog = $this->dic->em->getRepository(PageUpdateLog::class)->getAllByPageId($this->request->identifier);
            }
        }
    }

    private function setTemplateName()
    {
        switch ($this->action) {
            case 'create-page':
            case 'edit-page':
                $this->templateName = 'edit';

                break;
            default:
                $this->templateName = 'index';

                break;
        }
    }

    /**
     * Save page
     */
    private function savePage()
    {
    }
}
