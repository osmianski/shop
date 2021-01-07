<?php

namespace App\Base\Hints;

use App\Products\Products;
use App\Sheets\Sheets;
use Osm\Core\App;

/**
 * @see \App\Sheets\Module:
 *      @property Sheets $app_sheets @required @default
 * @see \App\Products\Module:
 *      @property Products $products @required @default
 */
abstract class AppHint extends App
{
}