<?php

namespace App\Tests;

use App\Base\Hints\AppHint;
use App\Products\Products;
use Osm\Core\App;
use Osm\Data\TableQueries\TableQuery;
use Osm\Framework\Db\Db;
use Osm\Framework\Testing\Tests\AppTestCase;

/**
 * @property Products $products
 */
class ProductsTest extends AppTestCase
{
    protected function default($property) {
        global $osm_app; /* @var App|AppHint $osm_app */

        switch ($property) {
            case 'products': return $osm_app->products;
        }

        return parent::default($property);
    }

    public function test_that_module_exists() {
        global $osm_app; /* @var App $osm_app */

        $this->assertTrue(isset($osm_app->modules['App_Products']));

        // check that a computed property actually works
        $this->assertNotNull($this->products);
    }

    public function test_inserting_a_product() {
        $this->executeAndRollback(function() {
            $id = $this->products->insert([
                'sku' => 'test',
                'title' => 'Test',
            ]);

            $this->assertEquals($id, $this->db['products']
                ->where("id = $id")
                ->value("id"));
        });
    }
}