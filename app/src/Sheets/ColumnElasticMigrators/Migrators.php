<?php

declare(strict_types=1);

namespace App\Sheets\ColumnElasticMigrators;

use Osm\Framework\Data\CollectionRegistry;

class Migrators extends CollectionRegistry
{
    public string $config = 'app_sheets_column_elastic_migrators';
    public string $not_found_message = "Sheet column Elastic migrator ':name' not found";

    protected function get(): array {
        $this->modified();
        return $this->config_;
    }
}