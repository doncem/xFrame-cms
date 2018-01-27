<?php

namespace XframeCMS\Controller\Helper;

use PackageVersions\Versions;

class IndexHelper extends AbstractHelper
{
    protected function getTemplateName()
    {
        return 'index';
    }

    protected function processRegular()
    {
        $this->view->package_versions = \array_map(function($value) {
            $versions = \explode('@', $value);
            return $versions[0];
        }, Versions::VERSIONS);
    }

    protected function processAJAX()
    {}
}
