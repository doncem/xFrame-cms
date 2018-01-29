<?php

namespace XframeCMS\Model\Request;

use Xframe\Registry;
use XframeCMS\Model\AbstractModel;

/**
 * Abstract request model which holds the responsibility to save registry to a file.
 */
abstract class AbstractRequest extends AbstractModel
{
    protected $config;

    /**
     * Is the registry valid?
     */
    abstract public function isValid();

    /**
     * Is config array valid?
     */
    abstract public function isConfigValid(array $config);

    /**
     * Process the registry.
     */
    abstract public function process(Registry $registry);

    /**
     * Initialise request model by assigning the config file name.
     */
    protected function __construct()
    {
        $this->config = \getenv('CONFIG') . '.ini';
    }

    /**
     * Save registry to config file.
     *
     * @return bool
     */
    protected function saveToIni(Registry $registry)
    {
        $file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $this->config;
        $contents = '';

        foreach ($registry as $section => $config) {
            $contents .= '[' . $section . ']' . PHP_EOL;

            foreach ($config as $key => $value) {
                if ($value instanceof bool ||
                    'IS_' === \mb_substr($key, 0, 3) ||
                    'on' === $value ||
                    'true' === $value ||
                    'false' === $value) {
                    $v = true === (bool) $value ? 'true' : 'false';
                } else {
                    $v = $value;
                }

                $contents .= $key . '=' . $v . PHP_EOL;
            }

            $contents .= PHP_EOL;
        }

        return \file_put_contents($file, $contents);
    }
}
