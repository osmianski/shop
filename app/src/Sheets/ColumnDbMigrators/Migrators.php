<?php

declare(strict_types=1);

namespace App\Sheets\ColumnDbMigrators;

use Osm\Framework\Data\CollectionRegistry;

class Migrators extends CollectionRegistry
{
    public string $config = 'app_sheets_column_db_migrators';
    public string $not_found_message = "Sheet column DB migrator ':name' not found";

    protected function get() {
        $this->modified();
        return $this->config_;
    }
}