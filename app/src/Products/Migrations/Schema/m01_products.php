<?php

namespace App\Products\Migrations\Schema;

use Osm\Data\Tables\Blueprint;
use Osm\Framework\Migrations\Migration;

class m01_products extends Migration
{
    public function up() {
        $this->db->create('products', function (Blueprint $table) {
            $table->string('sku')->title("SKU")
                ->unique()->required();
            $table->string('title')->title("Title")
                ->index()->required();
        });
    }

    public function down() {
        $this->db->drop('products');
    }
}
