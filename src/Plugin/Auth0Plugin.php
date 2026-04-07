<?php

namespace XframeCMS\Plugin;

use Auth0\SDK\Auth0;
use Xframe\Plugin\AbstractPlugin;

/**
 * Auth0 plugin.
 */
class Auth0Plugin extends AbstractPlugin
{
    /**
     * Construct Auth0 client.
     *
     * @return Auth0
     */
    public function init()
    {
        return new Auth0([
            'domain'        => $this->dic->registry->auth0->AUTH0_DOMAIN,
            'redirectUri'   => $this->dic->registry->auth0->AUTH0_CALLBACK_URL,
            'clientId'      => $this->dic->registry->auth0->AUTH0_CLIENT_ID,
            'clientSecret'  => $this->dic->registry->auth0->AUTH0_CLIENT_SECRET,
            'cookieSecret'  => $this->dic->registry->auth0->AUTH0_COOKIE_SECRET
        ]);
    }
}
