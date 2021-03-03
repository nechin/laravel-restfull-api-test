<?php

namespace App\Transformers;

class CustomerTransformer
{
    /**
     * @param object $customer
     * @return array
     */
    public function transform(object $customer): array
    {
        return [
            'id' => $customer->getId(),
            'fullName' => $customer->getFullName(),
            'email' => $customer->getEmail(),
            'country' => $customer->getCountry(),
            'username' => $customer->getUsername(),
            'gender' => $customer->getGender(),
            'city' => $customer->getCity(),
            'phone' => $customer->getPhone(),
        ];
    }

    /**
     * @param array $customers
     * @return array
     */
    public function transformAll(array $customers): array
    {
        return array_map(
            function ($customer) {
                return [
                    'id' => $customer->getId(),
                    'fullName' => $customer->getFullName(),
                    'email' => $customer->getEmail(),
                    'country' => $customer->getCountry(),
                ];
            }, $customers
        );
    }
}
