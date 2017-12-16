<?php

namespace XframeCMS\Model\Request;

use PDOException;
use Xframe\Container;
use Xframe\Core\DependencyInjectionContainer;
use Xframe\Plugin\DefaultCachePlugin;
use Xframe\Registry;
use Xframe\Registry\CacheRegistry;
use Xframe\Request\Request;

final class CacheSetup extends AbstractRequest
{
    /**
     * @var CacheRegistry
     */
    private $registry;

    public function __construct(Request $request)
    {
        parent::__construct();

        $this->registry = new CacheRegistry([
            'CACHE_CLASS' => $request->{'cache-class'},
            'ENABLED' => $request->{'cache-enabled'},
            'HOST' => $request->{'cache-host'},
            'PORT' => $request->{'cache-port'}
        ]);
    }

    public function isValid()
    {
        $valid = !$this->registry->ENABLED;

        if (!$valid) {
            if (\class_exists($this->registry->CACHE_CLASS)) {
                $dic = new DependencyInjectionContainer();
                $dic->registry = new Container();
                $dic->registry->cache = $this->registry;

                $plugin = new DefaultCachePlugin($dic);

                try {
                    $valid = $plugin->init() instanceof $this->registry->CACHE_CLASS;
                } catch (PDOException $e) {
                    $valid = false;
                }
            } else {
                $valid = false;
                $this->registry->ENABLED = false;
            }
        }

        return $valid;
    }

    public function isConfigValid(array $config)
    {
        $this->registry = new CacheRegistry($config);

        return $this->isValid();
    }

    public function process(Registry $registry)
    {
        $registry->cache = $this->registry;

        return $this->saveToIni($registry);
    }
}
