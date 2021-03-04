<?php

namespace App\Services\DataProvider;

use App\Services\DataProvider\Contracts\Provider;

abstract class BaseProvider implements Provider
{
    /**
     * @param int $limit
     * @return string
     */
    abstract public function getProviderUri(int $limit): string;

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
