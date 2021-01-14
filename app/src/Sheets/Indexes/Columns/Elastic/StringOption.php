<?php

declare(strict_types=1);

namespace App\Sheets\Indexes\Columns\Elastic;

class StringOption extends Column
{
    public function create(array &$params): void {
        $params = osm_merge($params, [
            'body' => [
                'mappings' => [
                    'properties' => [
                        $this->name => [
                            'type' => 'keyword',
                        ],
                    ],
                ],
            ],
        ]);
    }
}