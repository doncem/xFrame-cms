<?php

namespace XframeCMS\Model\Request;

use Xframe\Registry;
use Xframe\Registry\Doctrine2Registry;
use Xframe\Request\Request;

/**
 * Doctrine2 setup request model.
 */
final class Doctrine2Setup extends AbstractRequest
{
    /**
     * @var Doctrine2Registry
     */
    private $registry;

    /**
     * Initialise model by assigning doctrine2 registry values from request object.
     */
    public function __construct(Request $request)
    {
        parent::__construct();

        $this->registry = new Doctrine2Registry([
            'AUTO_REBUILD_PROXIES' => $request->{'doctrine-proxies'}
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
        $this->registry = new Doctrine2Registry($config);

        return $this->isValid();
    }

    /**
     * {@inheritdoc}
     */
    public function process(Registry $registry)
    {
        $registry->doctrine2 = $this->registry;

        return $this->saveToIni($registry);
    }
}
