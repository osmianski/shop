<?php

declare(strict_types=1);

namespace App\Sheets\Sheets\Columns\Table;

class Id extends Column
{
    protected function get_primary(): bool {
        return true;
    }
}