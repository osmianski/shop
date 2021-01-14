<?php

declare(strict_types=1);

namespace App\Sheets;

use App\Sheets\Indexes\IndexTypes;
use App\Sheets\Sheets\Columns\ColumnTypes;
use Osm\Core\App;
use Osm\Core\Modules\BaseModule;
use Osm\Core\Properties;

/**
 * @property ColumnTypes|string[] $sheet_column_types @required
 * @property IndexTypes|string[] $index_types @required
 */
class Module extends BaseModule
{
    /**
     * @var string[]
     */
    public array $hard_dependencies = [
        'App_Base',
        'Osm_Data_Files',
        'App_Elastic',
    ];

    /**
     * @var string[]
     */
    public array $traits = [
        Properties::class => Traits\PropertiesTrait::class,
    ];

    /** @noinspection PhpUnused */
    protected function get_sheet_column_types(): ColumnTypes {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->cache->remember("app_sheet_columns_types", function($data) {
            return ColumnTypes::new($data);
        });
    }

    /** @noinspection PhpUnused */
    protected function get_index_types(): IndexTypes {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->cache->remember("app_index_types", function($data) {
            return IndexTypes::new($data);
        });
    }
}