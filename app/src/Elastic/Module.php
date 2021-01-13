<?php

namespace App\Elastic;

use Osm\Core\Modules\BaseModule;
use Osm\Core\Properties;

class Module extends BaseModule
{
    public array $hard_dependencies = [
        'App_Base',
    ];

    public array $traits = [
        Properties::class => Traits\PropertiesTrait::class,
    ];
}