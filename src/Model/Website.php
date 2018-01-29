<?php

namespace XframeCMS\Model;

use Xframe\Core\DependencyInjectionContainer;

/**
 * CMS Website contents.
 */
class Website
{
    /**
     * @var string
     */
    private $webFile;

    /**
     * @var array
     */
    private $web;

    /**
     * @var Website
     */
    private static $instance;

    /**
     * Initialise Website by reading <code>webFile</code> contents into a <code>stdObject</code>.
     */
    private function __construct(string $webFile)
    {
        $this->webFile = $webFile;
        $this->web = \json_decode(\file_get_contents($webFile));
    }

    /**
     * @return Website
     */
    public static function getInstance(DependencyInjectionContainer $dic)
    {
        if (self::$instance instanceof Website) {
            return self::$instance;
        }

        return new Website($dic->root . 'website.json');
    }

    /**
     * @return \stdClass
     */
    public function getWebData()
    {
        return $this->web;
    }

    /**
     * Save web data to a file.
     */
    public function saveWebData(\stdClass $web)
    {
        \file_put_contents($this->webFile, \json_encode($web, 	JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
