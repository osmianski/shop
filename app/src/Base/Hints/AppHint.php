<?php

namespace App\Base\Hints;

use App\Elastic\Index;
use App\Elastic\Cluster;
use App\Products\Products;
use App\Sheets\Sheets;
use Osm\Core\App;

/**
 * @see \App\Sheets\Module:
 *      @property Sheets $app_sheets @required @default
 * @see \App\Products\Module:
 *      @property Products $products @required @default
 * @see \App\Elastic\Module:
 *      @property Cluster|Index[] $elastic @required @default
 */
abstract class AppHint extends App
{
}