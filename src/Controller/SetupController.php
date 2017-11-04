<?php

namespace XframeCMS\Controller;

use Xframe\Request\Controller;
use XframeCMS\Model\Request\DbSetup;

final class SetupController extends Controller
{
    public function init()
    {
        if ($this->dic->registry->setup->IS_SET) {
            $this->redirect('/');
        }
    }

    /**
     * @Request setup
     * @Prefilter \XframeCMS\Prefilter\UserPrefilter
     */
    public function setup()
    {
        $this->view->registry = $this->dic->registry;
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
            case 'db':
                $model = new DbSetup($this->request);

                $this->view->verified = $model->isValid();

                break;
            default:
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
            case 'db':
                $model = new DbSetup($this->request);

                if ($model->isValid()) {
                    $model->process($this->dic->registry);

                    $this->view->success = true;
                } else {
                    $this->view->success = false;
                }

                break;
            default:
                break;
        }
    }
}
