<?php

namespace XframeCMS\Controller\Helper;

use Xframe\Core\DependencyInjectionContainer;
use Xframe\Request\Request;
use Xframe\View\View;

abstract class AbstractHelper
{
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
    protected $request;

    /**
     * View template.
     *
     * @var View
     */
    protected $view;

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
     * @param Request                       $request
     * @param View                          $view
     * @param string                        $action
     * @param array                         $user
     */
    public function __construct(DependencyInjectionContainer $dic,
                                Request $request,
                                View $view,
                                string $action,
                                array $user = [])
    {
        // if (is_null($user) && get_called_class() != "admin\\helpers\\Auth") {
        //     header("location:/admin");
        // }

        $this->dic = $dic;
        $this->request = $request;
        $this->view = $view;
        $this->action = $action;
        $this->user = $user;
    }

    public function process()
    {
        if (0 === \mb_strpos($this->request->getRequestedResource(), 'ajax-')) {
            $this->processType = "AJAX";

            return $this->processAJAX();
        } else {
            $this->processType = "regular";

            return $this->processRegular();
        }

        $this->view->setTemplate($this->request->getRequestedResource() . DIRECTORY_SEPARATOR . $this->getTemplateName());
    }

    /**
     * General redirector. Goes to current action and extra parameters if any defined.
     *
     * @param string $parameter
     */
    protected function redirect($parameter = null)
    {
        header("location:/admin/{$this->action}" . (strlen($parameter) > 0 ? "/{$parameter}" : ""));
    }

    /**
     * Get type of process: AJAX || regular.
     *
     * @return string
     */
    public function getProcessType()
    {
        return $this->processType;
    }

    abstract protected function getTemplateName();

    /**
     * Contains 'error' key with message if something went wrong, and 'data' key if anything must be passed.
     */
    abstract protected function processRegular();

    /**
     * On any AJAX call prefixed with 'ajax-' - execute this method.
     */
    abstract protected function processAJAX();
}
