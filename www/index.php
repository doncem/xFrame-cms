<?php

$root = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
$loader = require $root . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// load .env variables to system

use Dotenv\Dotenv;

$env = new Dotenv($root);
$env->load();

$config = \getenv('CONFIG') ?: 'live';

// init app

use Xframe\Container;
use Xframe\Core\System;
use Xframe\Exception\Logger;
use Xframe\Registry;
use Xframe\Request\Request;

function findSetupStatus(Registry $registry)
{
    if (null === $registry->setup) {
        $registry->setup = new Container();
        $registry->setup->IS_SET = false;
    } elseif (null === $registry->setup->IS_SET) {
        $registry->setup->IS_SET = false;
    }
}

$system = new System($root, $config);

$system->boot();

findSetupStatus($system->registry);

// add PSR4 prefix if present

$loader->addPsr4('XframeCMS\\', $root . 'src');

// override default exception handlers

foreach ($system->exceptionHandler->getObservers() as $observer) {
    $system->exceptionHandler->detach($observer);
}

use XframeCMS\Exception\Observer\ExceptionWebView;

$system->exceptionHandler->attach(new Logger());
$system->exceptionHandler->attach(new ExceptionWebView($system));

// exec the request

$request = new Request(\filter_input(INPUT_SERVER, 'REQUEST_URI'), $_REQUEST);
$system->getFrontController()->dispatch($request);
