<?php

namespace App\Base\Hints;

use App\Products\Products;
use Osm\Core\App;

/**
 * @see \App\Products\Module:
 *      @property Products $products @required @default
 */
abstract class AppHint extends App
{
}