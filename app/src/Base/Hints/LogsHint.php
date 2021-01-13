<?php

declare(strict_types=1);

namespace App\Base\Hints;

use Osm\Framework\Logging\Logs;
use Psr\Log\LoggerInterface;

/**
 * @see \App\Elastic\Module:
 *
 * @property LoggerInterface $elastic @required @default
 */
abstract class LogsHint extends Logs
{

}