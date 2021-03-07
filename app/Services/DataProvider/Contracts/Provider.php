<?php

namespace App\Services\DataProvider\Contracts;

interface Provider
{
    /**
     * @param string $count
     * @return string
     */
    public function getProviderUri(string $count): string;

    /**
     * @return array
     */
    public function getFieldsMap(): array;

    /**
     * @return array
     */
    public function getFilters(): array;
}
