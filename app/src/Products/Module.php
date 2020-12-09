<?php

namespace App\Products;

use Osm\Core\Modules\BaseModule;
use Osm\Core\Properties;

class Module extends BaseModule
{
    public $hard_dependencies = [
        'App_Base',
    ];

    public $traits = [
        Properties::class => Traits\PropertiesTrait::class,
    ];
}