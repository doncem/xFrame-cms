<?php

$root = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
$loader = require $root . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = \filter_input(INPUT_SERVER, 'CONFIG') ?: 'live';

use Xframe\Core\System;
use Xframe\Request\Request;

$system = new System($root, $config);

$system->boot();
$system->registry->set('isLive', 'live' === $config);

$loader->addPsr4($system->registry->request->NAMESPACE_PREFIX, $root . 'src');

$request = new Request(\filter_input(INPUT_SERVER, 'REQUEST_URI'), $_REQUEST);
$system->getFrontController()->dispatch($request);
