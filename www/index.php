<?php

$root = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
$loader = require $root . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = \filter_input(INPUT_SERVER, 'CONFIG') ?: 'live';

use Xframe\Core\System;
use Xframe\Registry;
use Xframe\Request\Request;
use XframeCMS\Config\Setup;

function getSetupStatus(Registry $registry)
{
    if (null === $registry->setup) {
        return false;
    } else {
        return Setup::DONE === $registry->setup->status;
    }
}

$system = new System($root, $config);

$system->boot();
$system->registry->set('isSet', getSetupStatus($system->registry));

$loader->addPsr4($system->registry->request->NAMESPACE_PREFIX, $root . 'src');

$request = new Request(\filter_input(INPUT_SERVER, 'REQUEST_URI'), $_REQUEST);
$system->getFrontController()->dispatch($request);
