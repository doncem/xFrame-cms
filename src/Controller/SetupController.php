<?php

namespace XframeCMS\Controller;

use ReflectionClass;
use Xframe\Request\Controller;
use XframeCMS\Model\Request\AbstractRequest;
use XframeCMS\Model\Setup;

final class SetupController extends Controller
{
    public function init()
    {
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

    private function getRegistryAsArray()
    {
        $registry = [];

        foreach ($this->dic->registry as $section => $sectionConfig) {
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

            $this->dic->registry->setup->{'IS_SET_' . \strtoupper($section)} = $model->isConfigValid($registry[$section]);
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
                    $this->view->success = (bool)$model->process($this->dic->registry);
                } else {
                    $this->view->success = false;
                }

                break;
        }
    }
}
