<?php

declare(strict_types=1);

namespace App\Sheets\Sheets\Columns\Table;

use Osm\Data\Tables\Blueprint;

class Bool_ extends Column
{
    public function create(Blueprint $table): void {
        $table->bool($this->name)->title($this->name)
            ->required()->value(false);
    }
}