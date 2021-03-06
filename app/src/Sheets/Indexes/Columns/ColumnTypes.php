<?php

declare(strict_types=1);

namespace App\Sheets\Indexes\Columns;

use Osm\Core\Exceptions\FactoryError;
use Osm\Framework\Data\CollectionRegistry;

class ColumnTypes extends CollectionRegistry
{
    public string $config = 'app_sheet_index_columns_types';
    public string $not_found_message = "Sheet index column type ':name' not found";

    protected function createItem($data, $name) {
        $class = Column::class;
        if (!is_a($data, $class, true)) {
            throw new FactoryError("Class $data should implement/subclass '$class'");
        }

        return $data;
    }
}