<?php

namespace App\Tests\Products;

use App\Base\Hints\AppHint;
use App\Products\Products;
use Osm\Core\App;
use Osm\Data\TableQueries\TableQuery;
use Osm\Framework\Db\Db;
use Osm\Framework\Testing\Tests\AppTestCase;

/**
 * @property Products $products
 */
class t99_SheetTest extends AppTestCase
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

        // GIVEN you created a `App_Products` module that adds the `products`
        // property to the global app object

        // WHEN you check the global app object
        // THEN the module is present in the module list
        $this->assertTrue(isset($osm_app->modules['App_Products']));

        // AND its `products` property is computed as defined in the module
        $this->assertNotNull($this->products);
    }

    public function test_inserting_a_product() {
        $this->executeAndRollback(function() {
            // GIVEN you insert a product
            $id = $this->products->insert([
                'sku' => 'test',
                'title' => 'Test',
            ]);

            // WHEN you check it in the underlying table
            // THEN it's there
            $this->assertEquals($id, $this->db['products']
                ->where("id = $id")
                ->value("id"));
        });
    }

    public function test_full_text_search() {
        $this->executeAndRollback(function() {
            // GIVEN a product
            $id = $this->products->insert([
                'sku' => 'test',
                'title' => 'Test',
            ]);

            // WHEN you search it by its name
            // THEN that product appears in the result
            $this->assertEquals($id, $this->products
                ->search('test')
                ->value('id')
            );
        });
    }
}