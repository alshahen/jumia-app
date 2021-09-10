<?php

namespace Tests\Unit;

use App\Jumia\Resource\Customer\CustomerResource;
use PHPUnit\Framework\TestCase;

class CustomerResourceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_customer_resource(): void
    {
        $resource = new CustomerResource();

        $resource->setName('Ahmed');
        $resource->setCode('+1234');
        $resource->setState(true);
        $resource->setCountry('Egypt');
        $resource->setPhone('01111111111');

        self::assertIsString($resource->getName());
        self::assertEquals('ahmed', $resource->getName());

        self::assertIsString($resource->getCode());
        self::assertEquals('+1234', $resource->getCode());

        self::assertIsBool($resource->getState());
        self::assertEquals(true, $resource->getState());

        self::assertIsString($resource->getCountry());
        self::assertEquals('egypt', $resource->getCountry());

        self::assertIsString($resource->getPhone());
        self::assertEquals('01111111111', $resource->getPhone());

        self::assertIsArray($resource->toArray());
        self::assertEquals(
            [
                'name' => 'ahmed',
                'phone' => '01111111111',
                'state' => true,
                'code' => '+1234',
                'country' => 'egypt'
            ],
            $resource->toArray()
        );

    }
}
