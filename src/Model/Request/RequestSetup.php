<?php

namespace XframeCMS\Model\Request;

use Xframe\Registry;
use Xframe\Registry\RequestRegistry;
use Xframe\Request\Request;

/**
 * Request setup request model.
 */
final class RequestSetup extends AbstractRequest
{
    /**
     * @var RequestRegistry
     */
    private $registry;

    /**
     * Initialise model by assigning request registry values from request object.
     */
    public function __construct(Request $request)
    {
        parent::__construct();

        $this->registry = new RequestRegistry([
            'DEFAULT_VIEW' => $request->{'request-view'},
            'AUTO_REBUILD' => $request->{'request-rebuild'}
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return \class_exists($this->registry->DEFAULT_VIEW);
    }

    /**
     * {@inheritdoc}
     */
    public function isConfigValid(array $config)
    {
        $this->registry = new RequestRegistry($config);

        return $this->isValid();
    }

    /**
     * {@inheritdoc}
     */
    public function process(Registry $registry)
    {
        $registry->request = $this->registry;

        return $this->saveToIni($registry);
    }
}
