<?php

namespace Yii1x\ActiveRecord\Contracts;

use Generator;

interface MigrationManagerInterface
{
    public function create(string $name);

    /**
     * @return PreMigrationInterface[]
     */
    public function up(?int $step = null): array;

    /**
     * @return PreMigrationInterface[]
     */
    public function down(?int $step = null): array;

    /**
     * @return PreMigrationInterface[]
     */
    public function redo(?int $step = null): array;

    /** @return Generator<int, PreMigrationInterface, mixed, void> */
    public function yieldUp(?int $step = null): Generator;

    /** @return Generator<int, PreMigrationInterface, mixed, void> */
    public function yieldDown(?int $step = null): Generator;

    /** @return Generator<int, PreMigrationInterface, mixed, void> */
    public function yieldRedo(?int $step = null): Generator;

    /**
     * @return PreMigrationInterface[]
     */
    public function newMigrations(?int $step = null): array;

    /**
     * @return PreMigrationInterface[]
     */
    public function migrationHistory(?int $limit = null): array;

    public function getMigrationPath(): string;
}
