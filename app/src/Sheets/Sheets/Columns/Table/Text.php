<?php

declare(strict_types=1);

namespace App\Sheets\Sheets\Columns\Table;

use Osm\Data\Tables\Blueprint;

class Text extends Column
{
    public function create(Blueprint $table) {
        $table->text($this->name)->title($this->name);
    }
}