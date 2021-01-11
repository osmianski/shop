<?php

use App\Products\Products;

return [
    'products' => [
        'class' => Products::class,
        'column_config' => [
            'id' => [
                'primary' => true,
            ],
            'sku' => [
                'required' => true,
                'db_migrator' => 'string',
            ],
            'url_key' => [
                'required' => true,
                'db_migrator' => 'string',
            ],
            'title' => [
                'required' => true,
                'db_migrator' => 'string',
            ],
            'summary' => [
                'db_migrator' => 'text',
            ],
            'description' => [
                'db_migrator' => 'text',
            ],
            'enabled' => [
                'db_migrator' => 'bool',
            ],
            'show_in_listing' => [
                'db_migrator' => 'bool',
            ],
            'show_in_search' => [
                'db_migrator' => 'bool',
            ],
            'price' => [
                'required' => true,
                'db_migrator' => 'price',
            ],
            'special_price' => [
                'db_migrator' => 'price',
            ],
            'special_starts_at' => [
                'db_migrator' => 'datetime',
            ],
            'special_ends_at' => [
                'db_migrator' => 'datetime',
            ],
            'meta_title' => [
                'db_migrator' => 'string',
            ],
            'meta_keywords' => [
                'db_migrator' => 'text',
            ],
            'meta_description' => [
                'db_migrator' => 'text',
            ],
            'image' => [
                'db_migrator' => 'file',
            ],
            'images' => [
                'db_migrator' => 'files',
            ],
            'related_products' => [
                'db_migrator' => 'products',
            ],
            'upsell_products' => [
                'db_migrator' => 'products',
            ],
            'crosssell_products' => [
                'db_migrator' => 'products',
            ],
        ],
    ],
];