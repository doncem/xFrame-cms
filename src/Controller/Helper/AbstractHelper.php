<?php

namespace XframeCMS\Controller\Helper;

use Xframe\Core\DependencyInjectionContainer;
use Xframe\Request\Request;
use Xframe\View\View;

/**
 * Abstract helper which runs the code and assigns template to <code>{requested resource}/{template name}</code>.
 */
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

    /**
     * Run the helper wrapper.
     */
    public function run()
    {
        $this->runAction();

        $this->view->setTemplate($this->request->getRequestedResource() . DIRECTORY_SEPARATOR . $this->getTemplateName() . '.twig');
    }

    /**
     * Assigns <code>true</code> to view variable <code>success</code>
     */
    protected function markAsSuccess()
    {
        $this->view->success = true;
    }

    /**
     * Assigns <code>false</code> to view variable <code>success</code>
     */
    protected function markAsFailed()
    {
        $this->view->success = false;
    }

    /**
     * Get template name.
     *
     * @return string
     */
    abstract protected function getTemplateName();

    /**
     * Run the helper.
     */
    abstract protected function runAction();
}
