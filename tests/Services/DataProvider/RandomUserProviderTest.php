<?php

namespace Services\DataProvider;

use App\Services\DataProvider\RandomUserProvider;
use PHPUnit\Framework\TestCase;

class RandomUserProviderTest extends TestCase
{
    public function testGetFieldsMap()
    {
        $provider = new RandomUserProvider();
        $fields = $provider->getFieldsMap();
        $this->assertNotEmpty($fields, 'Fields map is empty');
        $this->assertIsArray($fields, 'Fields map is not array');
        $this->assertCount(8, $fields, 'Fields map result length is not an 8');
        $this->assertArrayHasKey('email', $fields, 'Fields map has no email key');
    }

    public function testGetProviderUri()
    {
        $provider = new RandomUserProvider();
        $uri = $provider->getProviderUri(1549);
        $this->assertNotEmpty($uri, 'Provide uri is empty');
        $this->assertIsString($uri, 'Provide uri is not a string');
        $this->assertStringContainsString('results=1549', $uri, 'Provide uri contain wrong data');
    }
}
