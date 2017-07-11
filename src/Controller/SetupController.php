<?php

namespace XframeCMS\Controller;

use Xframe\Request\Controller;

final class SetupController extends Controller
{
    /**
     * @Request setup
     * @Parameter -> ["status", "Xframe\\Validation\\Regex('/\\b/i')", false, "XframeCMS\\Config\\Setup::NONE"]
     */
    public function setup()
    {
    }
}
