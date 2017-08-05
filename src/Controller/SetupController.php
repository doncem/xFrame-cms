<?php

namespace XframeCMS\Controller;

use Xframe\Request\Controller;

final class SetupController extends Controller
{
    /**
     * @Request setup
     * @Prefilter \XframeCMS\Prefilter\AclPrefilter
     */
    public function setup()
    {
    }
}
