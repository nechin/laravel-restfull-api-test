<?php

namespace App\Services\DataProvider;

use App\Services\DataProvider\Contracts\Provider;

abstract class BaseProvider implements Provider
{
    /**
     * @param string $count
     * @return string
     */
    abstract public function getProviderUri(string $count): string;

    /**
     * Returns an array of filters if the results cannot be filtered by parameters in the query
     * @return array
     */
    abstract public function getFilters(): array;

    /**
     * @return string[]
     */
    public function getFieldsMap(): array
    {
        return [
            'firstName' => 'firstName',
            'lastName' => 'lastName',
            'email' => 'email',
            'country' => 'nat',
            'username' => 'username',
            'gender' => 'gender',
            'city' => 'city',
            'phone' => 'phone',
        ];
    }
}
