<?php

namespace XframeCMS\Model\Request;

use Xframe\Registry;
use XframeCMS\Model\AbstractModel;

abstract class AbstractRequest extends AbstractModel
{
    protected $config;

    abstract public function isValid();

    abstract public function process(Registry $registry);

    protected function __construct()
    {
        $this->config = \getenv('CONFIG') . '.ini';
    }

    protected function saveToIni(Registry $registry)
    {
        $file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $this->config;
        $contents = '';

        foreach ($registry as $section => $config) {
            $contents .= '[' . $section . ']' . PHP_EOL;

            foreach ($config as $key => $value) {
                $contents .= $key . '=' . $value . PHP_EOL;
            }

            $contents .= PHP_EOL;
        }

        \file_put_contents($file, $contents);
    }
}
