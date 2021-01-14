<?php

declare(strict_types=1);

namespace App\Sheets\Indexes;

use Osm\Core\Exceptions\FactoryError;
use Osm\Framework\Data\CollectionRegistry;

class IndexTypes extends CollectionRegistry
{
    public string $config = 'app_index_types';
    public string $not_found_message = "Sheet index type ':name' not found";

    protected function createItem($data, $name) {
        $class = Index::class;
        if (!is_a($data, $class, true)) {
            throw new FactoryError("Class $data should implement/subclass '$class'");
        }

        return $data;
    }
}