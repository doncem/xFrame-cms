<?php

namespace XframeCMS\Controller;

use ReflectionClass;
use XframeCMS\AbstractController;
use XframeCMS\Model\Request\AbstractRequest;
use XframeCMS\Model\Setup;

/**
 * Controller for setup actions.
 */
final class SetupController extends AbstractController
{
    /**
     * In case web is set - disallow executing the rest of the controller actions.
     */
    public function init()
    {
        parent::init();

        if ($this->dic->registry->setup->IS_SET) {
            $this->redirect('/');
        }
    }

    /**
     * @param string $step
     *
     * @return AbstractRequest
     */
    private function getRequestModel(string $step)
    {
        $class = '\\XframeCMS\\Model\\Request\\' . \ucfirst($step) . 'Setup';

        return new $class($this->request);
    }

    /**
     * Get all the registry as an array.
     */
    private function getRegistryAsArray()
    {
        $registry = [];

        foreach ($this->dic->registry as $section => $sectionConfig) {
            if ('auth0' === $section) {
                continue;
            }

            $registry[$section] = [];
            $reflecton = new ReflectionClass($sectionConfig);
            $constants = $reflecton->getConstants();

            if (!empty($constants)) {
                foreach ($constants as $key => $value) {
                    $registry[$section][$key] = $sectionConfig->$key;
                }
            } else {
                foreach ($sectionConfig as $key => $value) {
                    $registry[$section][$key] = $value;
                }
            }

            $model = $this->getRequestModel($section);

            $this->dic->registry->setup->{'IS_SET_' . \mb_strtoupper($section)} = $model->isConfigValid($registry[$section]);
        }

        return $registry;
    }

    /**
     * @Request setup
     * @Prefilter \XframeCMS\Prefilter\UserPrefilter
     */
    public function setup()
    {
        $registry = $this->getRegistryAsArray();
        $registry['database']['PASSWORD'] = '';

        $this->view->registry = $registry;
        $this->view->descriptions = Setup::DESCRIPTIONS;
        $this->view->icons = Setup::ICONS;
    }

    /**
     * Include config of itself - setup section.
     */
    private function setSetupImaginaryForm()
    {
        $registry = $this->getRegistryAsArray();

        foreach ($registry['setup'] as $key => $value) {
            $this->request->$key = $value;
        }
    }

    /**
     * @Request setup-verify
     * @Parameter -> ["step", null, true]
     * @View \Xframe\View\JsonView
     * @Prefilter \XframeCMS\Prefilter\UserPrefilter
     */
    public function verify()
    {
        switch ($this->request->step) {
            case 'setup':
                $this->setSetupImaginaryForm();
            default:
                $this->view->verified = $this->getRequestModel($this->request->step)->isValid();

                break;
        }
    }

    /**
     * @Request setup-save
     * @Parameter -> ["step", null, true]
     * @View \Xframe\View\JsonView
     * @Prefilter \XframeCMS\Prefilter\UserPrefilter
     */
    public function save()
    {
        switch ($this->request->step) {
            case 'setup':
                $this->setSetupImaginaryForm();
            default:
                $model = $this->getRequestModel($this->request->step);

                if ($model->isValid()) {
                    $this->view->success = (bool) $model->process($this->dic->registry);
                } else {
                    $this->view->success = false;
                }

                break;
        }
    }
}
