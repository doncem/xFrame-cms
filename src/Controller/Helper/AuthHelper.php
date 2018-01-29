<?php

namespace XframeCMS\Controller\Helper;

/**
 * Description of Auth
 * @package admin_helpers
 */
abstract class AuthHelper extends AbstractHelper {

    const COOKIE_LIFETIME = 3600;

    private $doRedirect = true;
    // private $error;

    public function getTemplateName() {
        if ($this->doRedirect) {
            throw new \Exception("You should not render anything directed to Auth helper", 0, null);
        } else {
            return "index";
        }
    }

    protected function processRegular() {
        // if ($this->action == "login") {
        //     $this->login();
        // } else {
        //     $this->logout();
        // }

        // if ($this->do_redirect) {
        //     header("location:/admin");
        //     exit();
        // }

        // return array("error" => $this->error);
    }

    protected function processAJAX() {}

    // private function login() {
    //     if (isset($this->request->username) && isset($this->request->password)) {
    //         $model = new db\User($this->dic->em);
    //         $user = $model->getByUsernameAndPassword($this->request->username, $this->request->password);

    //         if ($user instanceof \admin\models\admUser) {
    //             if ($user->getActive()) {
    //                 $session_id = date("ymd") . md5(mt_rand(100, 999)) . date("His");
    //                 self::updateCookie($session_id);
    //                 $user->last_session = $session_id;
    //                 $user->last_login = new \DateTime();
    //                 $model->save($user);
    //             } else {
    //                 $this->do_redirect = false;
    //                 $this->error = "User is not active. Check your email";
    //             }
    //         } else {
    //             $this->do_redirect = false;
    //             $this->error = "Wrong username and/or password";
    //         }
    //     }
    // }

    // private function logout() {
    //     self::destroyCookie();
    // }

    /**
     * Check if current user is logged in
     * @param string $userSession
     * @return boolean
     */
    public static function isLoggedIn($userSession) {
        // return filter_input(INPUT_COOKIE, "session_id") === $user_session && strlen($user_session) == 44;
    }

    /**
     * Updating for self::COOKIE_LIFETIME starting from now
     * @param string $sessionId
     */
    public static function updateCookie($sessionId) {
        // setcookie("session_id", $session_id, time() + self::COOKIE_LIFETIME, "/", null, false, true);
    }

    /**
     * DESTROY!
     */
    public static function destroyCookie() {
        // setcookie("session_id", "", time() - (60 * 60 * 24), "/", null, false, true);
    }
}
