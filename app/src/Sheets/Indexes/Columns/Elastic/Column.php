<?php

declare(strict_types=1);

namespace App\Sheets\Indexes\Columns\Elastic;

use App\Sheets\Indexes\Columns\Column as BaseColumn;

class Column extends BaseColumn
{
    public function create(array &$params): void {
        // by default, do nothing
    }
}