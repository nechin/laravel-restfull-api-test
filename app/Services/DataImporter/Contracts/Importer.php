<?php

namespace App\Services\DataImporter\Contracts;

interface Importer
{
    /**
     * @param string $count
     */
    public function setCount(string $count): void;

    /**
     * @return string
     */
    public function run(): string;
}
