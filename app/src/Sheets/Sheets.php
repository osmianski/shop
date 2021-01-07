<?php

declare(strict_types=1);

namespace App\Sheets;

use Osm\Framework\Data\ObjectRegistry;

class Sheets extends ObjectRegistry
{
    public string $class_ = Sheet::class;
    public string $config = 'app_sheets';
    public string $not_found_message = "Sheet ':name' not found";
}