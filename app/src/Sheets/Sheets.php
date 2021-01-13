<?php

declare(strict_types=1);

namespace App\Sheets;

use Osm\Core\App;
use Osm\Data\TableQueries\TableQuery;
use Osm\Data\Tables\Blueprint;
use Osm\Framework\Data\ObjectRegistry;
use Osm\Framework\Db\Db;

/**
 * @property Db|TableQuery[] $db @required
 */
class Sheets extends ObjectRegistry
{
    public string $class_ = Sheet::class;
    public string $config = 'app_sheets';
    public string $not_found_message = "Sheet ':name' not found";

    /** @noinspection PhpUnused */
    protected function get_db(): Db {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->db;
    }

    public function create(string $sheetName) {
        $sheet = $this[$sheetName]; /* @var Sheet $sheet */

        $this->db->create($sheetName, function (Blueprint $table) use ($sheet) {
            foreach ($sheet->columns as $column) {
                $column->createInTable($table);
            }
        });

        foreach ($sheet->columns as $column) {
            $column->afterAdding();
        }

        $sheet->search_engine->reindex();
    }

    public function drop(string $sheetName) {
        //$sheet = $this[$sheetName]; /* @var Sheet $sheet */
        $this->db->drop($sheetName);

    }

}