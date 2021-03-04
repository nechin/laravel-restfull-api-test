<?php

namespace App\Services\DataImporter\Contracts;

interface Importer
{
    /**
     * @param int $limit
     */
    public function run(int $limit): void;
}
