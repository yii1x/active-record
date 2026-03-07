<?php

namespace Yii1x\ActiveRecord\Contracts;

interface PreMigrationInterface
{
    public const string STATUS_NEW = 'new';
    public const string STATUS_APPLIED = 'applied';
    public const string STATUS_REVERTED = 'reverted';
    public const string STATUS_FAILED = 'failed';

    public function getName(): string;

    public function getStatus(): string;

    public function setStatus(string $status): static;

    public function whenApplied(): string;

    public function setApplyTime(?int $applyTime): static;
    public function getExecutionTime(): ?float;
    public function getExecutionTimeHuman(): ?string;

    public function up(): bool;

    public function down(): bool;

    public function getDebug(): array;
}
