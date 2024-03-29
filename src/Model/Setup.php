<?php

namespace XframeCMS\Model;

/**
 * Static container for view content.
 */
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
        'request' => 'network-wired',
        'database' => 'database',
        'doctrine2' => 'database',
        'twig' => 'html5',
        'cache' => 'server',
        'plugin' => 'plug',
        'setup' => 'gears'
    ];
}
