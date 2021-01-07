<?php

declare(strict_types=1);

namespace App\Samples\Sheets;

use Osm\Core\Modules\BaseModule;

class Module extends BaseModule
{
    /**
     * @var string[]
     */
    public array $hard_dependencies = [
        'App_Sheets',
    ];
}