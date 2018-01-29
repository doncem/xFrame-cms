<?php

namespace XframeCMS\Plugin;

use Xframe\Plugin\AbstractPlugin;
use XframeCMS\Plugin\Helper\Auth0PluginHelper;

/**
 * Auth0 plugin.
 */
class Auth0Plugin extends AbstractPlugin
{
    /**
     * Construct Auth0 client.
     *
     * @return Auth0PluginHelper
     */
    public function init()
    {
        $auth0Audience = \getenv('AUTH0_AUDIENCE');
        $auth0Callback = \getenv('AUTH0_CALLBACK_URL');
        $auth0ClientId = \getenv('AUTH0_CLIENT_ID');
        $auth0ClientSecret = \getenv('AUTH0_CLIENT_SECRET');
        $auth0Domain = \getenv('AUTH0_DOMAIN');

        return new Auth0PluginHelper([
            'domain' => $auth0Domain,
            'client_id' => $auth0ClientId,
            'client_secret' => $auth0ClientSecret,
            'redirect_uri' => $auth0Callback,
            'audience' => $auth0Audience,
            'scope' => 'openid profile',
            'persist_id_token' => true,
            'persist_access_token' => true,
            'persist_refresh_token' => true,
        ]);
    }
}
