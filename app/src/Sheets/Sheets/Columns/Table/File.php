<?php

declare(strict_types=1);

namespace App\Sheets\Sheets\Columns\Table;

use Osm\Data\Tables\Blueprint;

class File extends Column
{
    public function create(Blueprint $table): void {
        $table->int($this->name)->unsigned()->title($this->name)
            ->references('files.id')->on_delete('set null')
            ->required($this->required ?? false);
    }

    public function afterCreated(): void {
        $this->db->alter('files', function (Blueprint $table) {
            $this->createBackReference($table, null, false);
        });
    }

    public function beforeDropping(): void {
        $this->db->alter('files', function (Blueprint $table) {
            $this->dropBackReference($table);
        });
    }
}