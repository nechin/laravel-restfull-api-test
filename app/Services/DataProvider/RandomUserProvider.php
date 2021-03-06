<?php

namespace App\Services\DataProvider;

use App\Services\DataProvider\Contracts\Provider;

class RandomUserProvider extends BaseProvider implements Provider
{
    /**
     * @param string $count
     * @return string
     */
    public function getProviderUri(string $count): string
    {
        return 'https://randomuser.me/api/?nat=AU&results=' . $count;
    }

    /**
     * Scheme for mapping data from provider to db with dot notation
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
