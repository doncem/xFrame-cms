<?php

namespace XframeCMS\Model\Request;

use PDO;
use PDOException;
use Xframe\Container;
use Xframe\Core\DependencyInjectionContainer;
use Xframe\Plugin\DefaultDatabasePlugin;
use Xframe\Registry;
use Xframe\Registry\DatabaseRegistry;
use Xframe\Request\Request;

final class DatabaseSetup extends AbstractRequest
{
    /**
     * @var DatabaseRegistry
     */
    private $registry;

    public function __construct(Request $request)
    {
        parent::__construct();

        $this->registry = new DatabaseRegistry([
            'USERNAME'  => $request->{'db-username'},
            'PASSWORD'  => $request->{'db-password'},
            'HOST'      => $request->{'db-host'},
            'PORT'      => $request->{'db-port'},
            'NAME'      => $request->{'db-name'},
            'PREFIX'    => $request->{'db-prefix'}
        ]);
    }

    public function isValid()
    {
        $dic = new DependencyInjectionContainer();
        $dic->registry = new Container();
        $dic->registry->database = $this->registry;

        $plugin = new DefaultDatabasePlugin($dic);

        try {
            $valid = $plugin->init() instanceof PDO;
        } catch (PDOException $e) {
            $valid = false;
        }

        return $valid;
    }

    public function isConfigValid(array $config)
    {
        // must re-confirm the host if not localhost
        // guide as to why https://www.cyberciti.biz/tips/how-do-i-enable-remote-access-to-mysql-database-server.html
        if ('localhost' !== $config['HOST']) { // don't care about IPs
            return false;
        }

        $this->registry = new DatabaseRegistry($config);

        return $this->isValid();
    }

    public function process(Registry $registry)
    {
        $registry->database = $this->registry;

        return $this->saveToIni($registry);
    }
}
