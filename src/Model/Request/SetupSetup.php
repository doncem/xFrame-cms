<?php

namespace XframeCMS\Model\Request;

use Xframe\Container;
use Xframe\Registry;
use Xframe\Request\Request;

final class SetupSetup extends AbstractRequest
{
    /**
     * @var Container
     */
    private $registry;

    public function __construct(Request $request)
    {
        parent::__construct();

        $this->registry = new Container([
            'IS_SET_REQUEST'    => $request->IS_SET_REQUEST,
            'IS_SET_DATABASE'   => $request->IS_SET_DATABASE,
            'IS_SET_DOCTRINE2'  => $request->IS_SET_DOCTRINE2,
            'IS_SET_TWIG'       => $request->IS_SET_TWIG,
            'IS_SET_CACHE'      => $request->IS_SET_CACHE,
            'IS_SET_PLUGIN'     => $request->IS_SET_PLUGIN
        ]);
    }

    public function isValid()
    {
        return (
            $this->registry->IS_SET_REQUEST &&
            $this->registry->IS_SET_DATABASE &&
            $this->registry->IS_SET_DOCTRINE2 &&
            $this->registry->IS_SET_TWIG &&
            $this->registry->IS_SET_CACHE &&
            $this->registry->IS_SET_PLUGIN
        );
    }

    public function isConfigValid(array $config)
    {
        $this->registry = new Container($config);

        return $this->isValid();
    }

    public function process(Registry $registry)
    {
        $registry->setup = $this->registry;
        $registry->setup->IS_SET = true;

        return $this->saveToIni($registry);
    }
}
