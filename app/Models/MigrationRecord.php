<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class MigrationRecord extends Model
{
    public $timestamps = false;

    // Desativa a tentativa de acessar uma tabela no banco de dados
    protected $table = 'migrations';
    protected $fillable = [];
    protected $primaryKey = 'migration';
    public $incrementing = false;
    protected $keyType = 'string';

    // Atributo virtual para controlar se a migration foi executada
    protected $attributes = [
        'executed' => false,
    ];

    public static function allMigrations(): Collection
    {
        // Busca as migrations executadas na tabela migrations
        $executedMigrations = DB::table('migrations')
            ->pluck('migration')
            ->toArray();

        return Collection::make(collect(File::files(database_path('migrations')))
            ->map(function ($file) use ($executedMigrations) {
                $fileName = $file->getFilename();
                $migrationName = pathinfo($fileName, PATHINFO_FILENAME); // Remove .php

                $record = new self();
                $record->migration = $fileName;
                $record->path = "database/migrations/".$file->getFilename();
                $record->content = File::get($file->getPathname());

                // Compara sem a extensão .php
                $record->executed = in_array($migrationName, $executedMigrations) ? true : false;
                return $record;
            })->all());
    }

    public function getExecutedAttribute(): bool
    {
        return $this->attributes['executed'];
    }
}
