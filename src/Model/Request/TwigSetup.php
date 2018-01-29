<?php

namespace XframeCMS\Model\Request;

use Xframe\Registry;
use Xframe\Registry\TwigRegistry;
use Xframe\Request\Request;

/**
 * Twig setup request model.
 */
final class TwigSetup extends AbstractRequest
{
    /**
     * @var TwigRegistry
     */
    private $registry;

    /**
     * Initialise model by assigning twig registry values from request object.
     */
    public function __construct(Request $request)
    {
        parent::__construct();

        $this->registry = new TwigRegistry([
            'AUTO_REBUILD' => $request->{'twig-rebuild'}
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isConfigValid(array $config)
    {
        $this->registry = new TwigRegistry($config);

        return $this->isValid();
    }

    /**
     * {@inheritdoc}
     */
    public function process(Registry $registry)
    {
        $registry->twig = $this->registry;

        return $this->saveToIni($registry);
    }
}
