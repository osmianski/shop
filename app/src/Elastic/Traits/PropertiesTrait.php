<?php

declare(strict_types=1);

namespace App\Elastic\Traits;

use App\Elastic\Cluster;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Osm\Core\App;
use Psr\Log\LoggerInterface;

trait PropertiesTrait
{
    /** @noinspection PhpUnused */
    public function App_Base_Hints_AppHint__elastic(): Cluster {
        return Cluster::new();
    }

    /** @noinspection PhpUnused */
    public function App_Base_Hints_LogsHint__elastic(): LoggerInterface {
        global $osm_app; /* @var App $osm_app */

        // create new logging channel
        $logger = new Logger('elastic');

        $handler = new StreamHandler($osm_app->path(
            "{$osm_app->temp_path}/log/elastic.log"));
        $logger->pushHandler($handler);

        return $logger;
    }
}