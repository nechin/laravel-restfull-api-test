<?php

namespace App\Services\DataProvider;

use App\Services\DataProvider\Contracts\Provider;

class RandomUserProvider extends BaseProvider implements Provider
{
    /**
     * @param int $limit
     * @return string
     */
    public function getProviderUri(int $limit): string
    {
        return 'https://randomuser.me/api/?nat=AU&results=' . $limit;
    }

    /**
     * Scheme for mapping data from provider to db
     *
     * @return array
     */
    public function getFieldsMap(): array
    {
        $map = parent::getFieldsMap();
        $map['firstName'] = 'name.first';
        $map['lastName'] = 'name.last';
        $map['username'] = 'login.username';
        $map['city'] = 'location.city';
        return $map;
    }
}
