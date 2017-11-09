<?php

namespace XframeCMS\Model\Request;

use Xframe\Registry;
use Xframe\Registry\RequestRegistry;
use Xframe\Request\Request;

final class RequestSetup extends AbstractRequest
{
    /**
     * @var RequestRegistry
     */
    private $registry;

    public function __construct(Request $request)
    {
        parent::__construct();

        $this->registry = new RequestRegistry([
            'DEFAULT_VIEW' => $request->{'request-view'},
            'AUTO_REBUILD' => $request->{'request-rebuild'}
        ]);
    }

    public function isValid()
    {
        return \class_exists($this->registry->DEFAULT_VIEW);
    }

    public function isConfigValid(array $config)
    {
        $this->registry = new RequestRegistry($config);

        return $this->isValid();
    }

    public function process(Registry $registry)
    {
        $registry->request = $this->registry;

        return $this->saveToIni($registry);
    }
}
