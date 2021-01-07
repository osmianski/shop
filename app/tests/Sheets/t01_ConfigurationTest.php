<?php

declare(strict_types=1);

namespace App\Tests\Sheets;

use App\Samples\Sheets\TPosts;
use Osm\Core\App;
use Osm\Framework\Testing\Tests\AppTestCase;

class t01_ConfigurationTest extends AppTestCase
{
    public function test_configuration() {
        // GIVEN a configuration already defined in a module configuration file
        global $osm_app; /* @var App $osm_app */

        // WHEN you request a sheet object
        /* @var TPosts $posts */
        $posts = $osm_app->app_sheets['t_posts'];

        // THEN you get them as defined in the configuration
        $this->assertEquals('t_posts', $posts->name);
    }
}