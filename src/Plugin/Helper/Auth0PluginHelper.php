<?php

namespace XframeCMS\Plugin\Helper;

use Auth0\SDK\Auth0;

/**
 * Plugin helper for Auth0.
 */
class Auth0PluginHelper extends Auth0
{
    /**
     * Retrieve cookie for auth0 code.
     */
    protected function getAuthorizationCode()
    {
        return \filter_input(INPUT_COOKIE, 'auth0code');
    }
}
