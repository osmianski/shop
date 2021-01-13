<?php

declare(strict_types=1);

namespace App\Tests\Sheets;

use App\Elastic\Index;
use App\Elastic\Cluster;
use App\Samples\Sheets\TPosts;
use Osm\Core\App;
use Osm\Framework\Testing\Tests\AppTestCase;

/**
 * @property Cluster|Index[] $elastic @required @default
 */
class t01_ConfigurationTest extends AppTestCase
{
    protected function get_elastic() {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->elastic;
    }

    public function test_configuration() {
        // GIVEN a configuration already defined in a module configuration file
        // AND there is a migration calling sheet's `create()` method
        global $osm_app; /* @var App $osm_app */

        // WHEN you request a sheet object
        /* @var TPosts $posts */
        $posts = $osm_app->app_sheets['t_posts'];

        // THEN you get it as defined in the configuration
        $this->assertEquals('t_posts', $posts->name);
        $this->assertArrayHasKey('title', $posts->columns);
        $this->assertTrue($posts->columns['title']->required);

        // AND the underlying table exists
        $this->assertIsObject($this->db->tables['t_posts']);
        $this->assertIsObject($this->db->tables['t_posts']->columns['title']);

        // AND the underlying Elastic index exists
        $this->assertTrue($this->elastic['t_posts']->exists());
    }
}