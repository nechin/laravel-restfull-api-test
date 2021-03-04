<?php

namespace App\Services\DataProvider\Contracts;

interface Provider
{
    /**
     * @param int $limit
     * @return string
     */
    public function getProviderUri(int $limit): string;

    /**
     * @return array
     */
    public function getFieldsMap(): array;
}
