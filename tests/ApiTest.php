<?php

class ApiTest extends TestCase
{
    public function testCustomersExample()
    {
        $customers = $this->get('customers/');

        $customers->assertResponseOk();
        $customers->seeJsonStructure([
            '*' => [
                'id', 'fullName', 'email', 'country'
            ]
        ]);
        $customers->seeJsonDoesntContains([
            '*' => [
                'username', 'gender', 'city', 'phone'
            ]
        ]);
    }

    public function testCustomerExample()
    {
        $customers = $this->get('customers/1');

        $customers->assertResponseOk();
        $customers->seeJsonStructure([
            'id',
            'fullName',
            'email',
            'country',
            'username',
            'gender',
            'city',
            'phone',
        ]);
    }
}
