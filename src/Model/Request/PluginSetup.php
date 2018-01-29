<?php

namespace XframeCMS\Model\Request;

use Xframe\Container;
use Xframe\Core\DependencyInjectionContainer;
use Xframe\Plugin\DefaultPluginContainerPlugin;
use Xframe\Registry;
use Xframe\Request\Request;

/**
 * Plugin setup request model.
 */
final class PluginSetup extends AbstractRequest
{
    /**
     * @var Container
     */
    private $registry;

    /**
     * Initialise model by assigning plugin registry values from request model.
     */
    public function __construct(Request $request)
    {
        parent::__construct();

        $this->registry = new Container($request->plugin ?? []);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        $dic = new DependencyInjectionContainer();
        $dic->registry = new Container();
        $dic->registry->plugin = $this->registry;
        $plugin = new DefaultPluginContainerPlugin($dic);

        try {
            $plugin->init();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isConfigValid(array $config)
    {
        $this->registry = new Container($config);

        return $this->isValid();
    }

    /**
     * {@inheritdoc}
     */
    public function process(Registry $registry)
    {
        $registry->plugin = $this->registry;

        return $this->saveToIni($registry);
    }
}
