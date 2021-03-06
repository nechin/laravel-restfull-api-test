<?php

namespace Transformers;

use App\Entities\Customer;
use App\Transformers\CustomerTransformer;
use PHPUnit\Framework\TestCase;

class CustomerTransformerTest extends TestCase
{
    public function testTransformAll()
    {
        $customers = [
            $this->createMock(Customer::class),
            $this->createMock(Customer::class),
            $this->createMock(Customer::class),
            $this->createMock(Customer::class),
        ];
        $transformer = new CustomerTransformer();
        $transformedData = $transformer->transformAll($customers);
        $this->assertIsArray($transformedData, 'Transformed data is not array');
        $this->assertCount(4, $transformedData, 'Transformed list result length is not a 4');
        $this->assertArrayHasKey('id', $transformedData[0], 'Customer data has no ID key');
        $this->assertArrayHasKey('fullName', $transformedData[0], 'Customer data has no fullName key');
        $this->assertArrayHasKey('email', $transformedData[0], 'Customer data has no email key');
        $this->assertArrayHasKey('country', $transformedData[0], 'Customer data has no country key');
    }

    public function testTransform()
    {
        $customer = $this->createMock(Customer::class);
        $transformer = new CustomerTransformer();
        $transformedData = $transformer->transform($customer);
        $this->assertArrayHasKey('id', $transformedData, 'Customer data has not ID key');
        $this->assertCount(8, $transformedData, 'Transformed result length is not an 8');
        $this->assertIsNumeric($transformedData['id'], 'Customer ID is not a number');
        $this->assertArrayHasKey('fullName', $transformedData, 'Customer data has not fullName key');
        $this->assertArrayHasKey('email', $transformedData, 'Customer data has no email key');
        $this->assertStringNotContainsString('@', $transformedData['email'], 'Not valid email');
        $this->assertArrayHasKey('country', $transformedData, 'Customer data has no country key');
        $this->assertArrayHasKey('username', $transformedData, 'Customer data has no username key');
        $this->assertArrayHasKey('gender', $transformedData, 'Customer data has no gender key');
        $this->assertArrayHasKey('city', $transformedData, 'Customer data has no city key');
        $this->assertArrayHasKey('phone', $transformedData, 'Customer data has no phone key');
    }
}
