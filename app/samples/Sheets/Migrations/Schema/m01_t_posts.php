<?php

namespace App\Samples\Sheets\Migrations\Schema;

use App\Sheets\Sheets;
use Osm\Core\App;
use Osm\Data\Tables\Blueprint;
use Osm\Framework\Migrations\Migration;

/**
 * @property Sheets $app_sheets @required
 */
class m01_t_posts extends Migration
{
    protected function get_app_sheets(): Sheets {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->app_sheets;
    }

    public function up() {
        $this->app_sheets->create('t_posts');
    }

    public function down() {
        $this->app_sheets->drop('t_posts');
    }
}
