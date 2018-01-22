<?php

namespace XframeCMS\Controller\Helper;

use Xframe\Core\DependencyInjectionContainer;
use Xframe\Request\Request;

/**
 * Description of AdminAuth
 * @package admin_helpers
 */
abstract class AbstractHelper {

    /**
     * Dependency injection container.
     *
     * @var DependencyInjectionContainer
     */
    protected $dic;

    /**
     * Requested action.
     *
     * @var string
     */
    protected $action;

    /**
     * Requested params.
     *
     * @var Request
     */
    protected $request = [];

    /**
     * Current user.
     *
     * @var array
     */
    protected $user = [];

    /**
     * Flag for type of process.
     *
     * @var string
     */
    private $process_type;

    /**
     * Initiate helper. Check if user is present.
     *
     * @param DependencyInjectionContainer  $dic
     * @param string                        $action
     * @param array                         $user
     */
    public function __construct(DependencyInjectionContainer $dic, string $action, array $user = []) {
        // if (is_null($user) && get_called_class() != "admin\\helpers\\Auth") {
        //     header("location:/admin");
        // }

        $this->dic = $dic;
        $this->action = $action;
        $this->user = $user;
    }

    /**
     * Set it.
     *
     * @param Request $request
     */
    public function setRequest(Request $request) {
        $this->request = $request;
    }

    public function process() {
        if (0 === \mb_strpos($this->request->getRequestedResource(), 'ajax-')) {
            $this->processType = "AJAX";

            return $this->processAJAX();
        } else {
            $this->processType = "regular";

            return $this->processRegular();
        }
    }

    /**
     * General redirector. Goes to current action and extra parameters if any defined.
     *
     * @param string $parameter
     */
    protected function redirect($parameter = null) {
        header("location:/admin/{$this->action}" . (strlen($parameter) > 0 ? "/{$parameter}" : ""));
    }

    /**
     * Get type of process: AJAX || regular.
     *
     * @return string
     */
    public function getProcessType() {
        return $this->processType;
    }

    abstract public function getTemplateName();

    /**
     * Contains 'error' key with message if something went wrong, and 'data' key if anything must be passed.
     *
     * @return array
     */
    abstract protected function processRegular();

    /**
     * On any AJAX call prefixed with 'ajax-' - execute this method.
     */
    abstract protected function processAJAX();
}
