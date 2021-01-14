<?php

declare(strict_types=1);

namespace App\Sheets\Sheets\Columns\Table;

use Osm\Data\Tables\Blueprint;

class DateTime extends Column
{
    public function create(Blueprint $table) {
        $table->datetime($this->name)->title($this->name)
            ->required($this->required ?? false);
    }
}