<?php

namespace XframeCMS\Exception;

final class Auth0Exception extends \Exception implements \Auth0\SDK\Exception\Auth0Exception
{

    public function __construct($message)
    {
        parent::__construct($message);
    }
}
