<?php

declare(strict_types=1);

namespace App\Sheets\Indexes\Columns\Elastic;

class Text extends Column
{
    public function create(array &$params): void {
        if ($this->sheet_column->search_weight === null) {
            return;
        }

        $params = osm_merge($params, [
            'body' => [
                'mappings' => [
                    'properties' => [
                        $this->name => [
                            'type' => 'text',
                        ],
                    ],
                ],
            ],
        ]);
    }
}