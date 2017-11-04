<?php

namespace XframeCMS\Prefilter;

use GuzzleHttp\Exception\RequestException;
use Xframe\Request\Controller;
use Xframe\Request\Prefilter;
use Xframe\Request\Request;

class UserPrefilter extends Prefilter
{
    public function run(Request $request, Controller $controller)
    {
        $session = $this->dic->plugin->auth0;

        try {
            $userInfo = $session->getUser();
        } catch (RequestException $e) {
            \setcookie('auth0code', '', -1);
            $userInfo = [];
        }

        if (!$userInfo) {
            $session->login(\filter_input(INPUT_COOKIE, 'auth0state'));
        } else {
            $controller->getView()->user = [
                'email' => $userInfo['name'],
                'picture' => $userInfo['picture']
            ];
        }

        return true;
    }

}
