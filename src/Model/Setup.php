<?php

namespace XframeCMS\Model;

final class Setup
{
    const DESCRIPTIONS = [
        'request' => 'Amend response layout and speed',
        'database' => 'Setup database connection',
        'doctrine2' => 'ORM features',
        'twig' => 'Templating',
        'cache' => 'Manage data caching',
        'plugin' => 'CMS extensions',
        'setup' => 'Final overview'
    ];

    const ICONS = [
        'request' => 'disk outline',
        'database' => 'database',
        'doctrine2' => 'database',
        'twig' => 'html5',
        'cache' => 'server',
        'plugin' => 'plug',
        'setup' => 'options'
    ];
}