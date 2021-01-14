<?php

use App\Products\Products;

return [
    'products' => [
        'class' => Products::class,
        'column_config' => [
            'id' => [
                'type' => 'id',
            ],
            'sku' => [
                'type' => 'string',
                'required' => true,
            ],
            'url_key' => [
                'type' => 'string',
                'required' => true,
            ],
            'title' => [
                'type' => 'string',
                'required' => true,
            ],
            'summary' => [
                'type' => 'text',
            ],
            'description' => [
                'type' => 'text',
            ],
            'enabled' => [
                'type' => 'bool',
            ],
            'show_in_listing' => [
                'type' => 'bool',
            ],
            'show_in_search' => [
                'type' => 'bool',
            ],
            'price' => [
                'type' => 'price',
                'required' => true,
            ],
            'special_price' => [
                'type' => 'price',
            ],
            'special_starts_at' => [
                'type' => 'datetime',
            ],
            'special_ends_at' => [
                'type' => 'datetime',
            ],
            'meta_title' => [
                'type' => 'string',
            ],
            'meta_keywords' => [
                'type' => 'text',
            ],
            'meta_description' => [
                'type' => 'text',
            ],
            'image' => [
                'type' => 'file',
            ],
            'images' => [
                'type' => 'files',
            ],
            'related_products' => [
                'type' => 'products',
            ],
            'upsell_products' => [
                'type' => 'products',
            ],
            'crosssell_products' => [
                'type' => 'products',
            ],
        ],
    ],
];