<?php

$root = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

$loader = require $root . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// load .env variables to system

use Dotenv\Dotenv;

$env = Dotenv::createImmutable($root)->load();

$config = $env['CONFIG'] ?: 'live';

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

function registerAuth0Vars(array $envVars, Registry $registry)
{
    $registry->auth0 = new Container();

    \array_walk($envVars, function ($value, $key) use ($registry) {
        if ('AUTH0' === \mb_substr($key, 0, 5)) {
            $registry->auth0->$key = $value;
        }
    });
}

$system = new System($root, $config);

$system->boot();

findSetupStatus($system->registry);
registerAuth0Vars($env, $system->registry);

// set namespace prefix

if ('' === $system->registry->request->NAMESPACE_PREFIX) {
    $src = \realpath($root . 'src');
    $prefix = \array_filter($loader->getPrefixesPsr4(), function ($item) use ($src) {
        return \in_array($src, \array_map('realpath', $item), true);
    });
    $system->registry->request->NAMESPACE_PREFIX = (string) \key($prefix);
}

// override default exception handlers

foreach ($system->exceptionHandler->getObservers() as $observer) {
    $system->exceptionHandler->detach($observer);
}

use XframeCMS\Exception\Observer\ExceptionWebView;

$system->exceptionHandler->attach(new Logger());
$system->exceptionHandler->attach(new ExceptionWebView($system));

// exec the request


$request = new Request(\filter_var($_SERVER['REQUEST_URI']), $_REQUEST);
$system->getFrontController()->dispatch($request);
