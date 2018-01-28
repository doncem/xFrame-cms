<?php

namespace XframeCMS\Controller\Helper;

use PackageVersions\Versions;
use XframeCMS\Model\Website;

class IndexHelper extends AbstractHelper
{
    protected function getTemplateName()
    {
        return 'index';
    }

    protected function runAction()
    {
        if (isset($this->request->{'admin-web-title'})) {
            $this->saveWebTitle();
        } else {
            $this->view->package_versions = \array_map(function($value) {
                $versions = \explode('@', $value);
                return $versions[0];
            }, Versions::VERSIONS);
        }
    }

    private function saveWebTitle()
    {
        $title = $this->request->{'admin-web-title'};

        if (\mb_strlen($title) > 0) {
            $web = Website::getInstance($this->dic)->getWebData();
            $web->title = $title;
            Website::getInstance($this->dic)->saveWebData($web);
            $this->markAsSuccess();
        } else {
            $this->markAsFailed();
        }
    }
}
