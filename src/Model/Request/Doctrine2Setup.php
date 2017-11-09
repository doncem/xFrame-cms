<?php

namespace XframeCMS\Model\Request;

use Xframe\Registry;
use Xframe\Registry\Doctrine2Registry;
use Xframe\Request\Request;

final class Doctrine2Setup extends AbstractRequest
{
    /**
     * @var Doctrine2Registry
     */
    private $registry;

    public function __construct(Request $request)
    {
        parent::__construct();

        $this->registry = new Doctrine2Registry([
            'AUTO_REBUILD_PROXIES' => $request->{'doctrine-proxies'}
        ]);
    }

    public function isValid()
    {
        return true;
    }

    public function isConfigValid(array $config)
    {
        $this->registry = new Doctrine2Registry($config);

        return $this->isValid();
    }

    public function process(Registry $registry)
    {
        $registry->doctrine2 = $this->registry;

        return $this->saveToIni($registry);
    }
}
