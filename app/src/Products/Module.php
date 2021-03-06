<?php

declare(strict_types=1);

namespace App\Products;

use Osm\Core\Modules\BaseModule;
use Osm\Core\Properties;

class Module extends BaseModule
{
    /**
     * @var string[]
     */
    public array $hard_dependencies = [
        'App_Base',
        'App_Sheets',
    ];

    /**
     * @var string[]
     */
    public array $traits = [
        Properties::class => Traits\PropertiesTrait::class,
    ];
}