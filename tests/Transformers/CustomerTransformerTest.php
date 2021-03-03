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
        $this->assertCount(4, $transformedData, 'Transformed data length is not a 4');
        $this->assertArrayHasKey('id', $transformedData[0], 'Customer data has not ID key');
    }

    public function testTransform()
    {
        $customer = $this->createMock(Customer::class);
        $transformer = new CustomerTransformer();
        $transformedData = $transformer->transform($customer);
        $this->assertArrayHasKey('id', $transformedData, 'Customer data has not ID key');
        $this->assertIsNumeric($transformedData['id'], 'Customer ID is not a number');
        $this->assertArrayHasKey('fullName', $transformedData, 'Customer data has not fullName key');
        $this->assertStringNotContainsString('@', $transformedData['email'], 'Not valid email');
    }
}
