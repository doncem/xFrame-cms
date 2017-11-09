<?php

namespace XframeCMS\Model\Request;

use Xframe\Registry;
use Xframe\Registry\TwigRegistry;
use Xframe\Request\Request;

final class TwigSetup extends AbstractRequest
{
    /**
     * @var TwigRegistry
     */
    private $registry;

    public function __construct(Request $request)
    {
        parent::__construct();

        $this->registry = new TwigRegistry([
            'AUTO_REBUILD' => $request->{'twig-rebuild'}
        ]);
    }

    public function isValid()
    {
        return true;
    }

    public function isConfigValid(array $config)
    {
        $this->registry = new TwigRegistry($config);

        return $this->isValid();
    }

    public function process(Registry $registry)
    {
        $registry->twig = $this->registry;

        return $this->saveToIni($registry);
    }
}
