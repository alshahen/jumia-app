<?php

namespace Tests\Unit;

use App\Jumia\Classification\CollectionClassification;
use App\Jumia\Classification\Filter\CountryFilter;
use App\Jumia\Classification\Filter\PhoneStateFilter;
use App\Jumia\Resource\Customer\CustomerResource;
use Tests\TestCase;

class ClassificationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_classification_country_without_state()
    {
        $dummyCustomers = collect([
            (object)[ 'name' => 'walid hammadi', 'phone' => '6007989253', 'country' => 'morocco', 'state' => false, 'code' => '212'],
            (object)[ 'name' => 'yosaf karrouch', 'phone' => '698054317', 'country' => 'morocco', 'state' => true, 'code' => '212'],
            (object)[ 'name' => 'tanvi sachdeva', 'phone' => '84330678235', 'country' => 'mozambique', 'state' => false, 'code' => '258'],
            (object)[ 'name' => 'filimon embaye', 'phone' => '914701723', 'country' => 'ethiopia', 'state' => true, 'code' => '251'],
            (object)[ 'name' => 'ogwal david', 'phone' => '7771031454', 'country' => 'uganda', 'state' => false, 'code' => '256'],
            (object)[ 'name' => 'arreymanyor roland tabot', 'phone' => '6A0311634', 'country' => 'cameroon', 'state' => false, 'code' => '237'],
            (object)[ 'name' => 'sugar starrk barragan', 'phone' => '6780009592', 'country' => 'cameroon', 'state' => false, 'code' => '237'],
        ]);

        foreach ($dummyCustomers as $customer){
            $resource = new CustomerResource();
            $resource->setName($customer->name);
            $resource->setPhone($customer->phone);
            $resource->setCountry($customer->country);
            $resource->setState($customer->state);
            $resource->setCode($customer->code);
            $customerResource[] = $resource;
        }
        $result = (new CollectionClassification($customerResource ?? null))
            ->classifiedBy(new CountryFilter('morocco'))
            ->classifiedBy(new PhoneStateFilter(null))
            ->getCollection();

        $expected = collect([
            (object)[ 'name' => 'walid hammadi', 'phone' => '6007989253', 'country' => 'morocco', 'state' => false, 'code' => '212'],
            (object)[ 'name' => 'yosaf karrouch', 'phone' => '698054317', 'country' => 'morocco', 'state' => true, 'code' => '212']
        ]);

        self::assertEquals($result->count(), $expected->count());

        foreach ($result->values() as $index => $customer){
            self::assertInstanceOf(CustomerResource::class, $customer);
            self::assertEquals($expected[$index]->name, $customer->getName());
            self::assertEquals($expected[$index]->phone, $customer->getPhone());
            self::assertEquals($expected[$index]->country, $customer->getCountry());
            self::assertEquals($expected[$index]->code, $customer->getCode());
            self::assertEquals($expected[$index]->state, $customer->getstate());
        }

    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_classification_country_with_state()
    {
        $dummyCustomers = collect([
            (object)[ 'name' => 'walid hammadi', 'phone' => '6007989253', 'country' => 'morocco', 'state' => false, 'code' => '212'],
            (object)[ 'name' => 'yosaf karrouch', 'phone' => '698054317', 'country' => 'morocco', 'state' => true, 'code' => '212'],
            (object)[ 'name' => 'tanvi sachdeva', 'phone' => '84330678235', 'country' => 'mozambique', 'state' => false, 'code' => '258'],
            (object)[ 'name' => 'filimon embaye', 'phone' => '914701723', 'country' => 'ethiopia', 'state' => true, 'code' => '251'],
            (object)[ 'name' => 'ogwal david', 'phone' => '7771031454', 'country' => 'uganda', 'state' => false, 'code' => '256'],
            (object)[ 'name' => 'arreymanyor roland tabot', 'phone' => '6A0311634', 'country' => 'cameroon', 'state' => false, 'code' => '237'],
            (object)[ 'name' => 'sugar starrk barragan', 'phone' => '6780009592', 'country' => 'cameroon', 'state' => false, 'code' => '237'],
        ]);

        foreach ($dummyCustomers as $customer){
            $resource = new CustomerResource();
            $resource->setName($customer->name);
            $resource->setPhone($customer->phone);
            $resource->setCountry($customer->country);
            $resource->setState($customer->state);
            $resource->setCode($customer->code);
            $customerResource[] = $resource;
        }

        $result = (new CollectionClassification($customerResource ?? null))
            ->classifiedBy(new CountryFilter('morocco'))
            ->classifiedBy(new PhoneStateFilter('valid'))
            ->getCollection();

        $expected = collect([
            (object)[ 'name' => 'yosaf karrouch', 'phone' => '698054317', 'country' => 'morocco', 'state' => true, 'code' => '212'],
        ]);

        self::assertEquals($result->count(), $expected->count());

        foreach ($result->values() as $index => $customer){
            self::assertInstanceOf(CustomerResource::class, $customer);
            self::assertEquals($expected[$index]->name, $customer->getName());
            self::assertEquals($expected[$index]->phone, $customer->getPhone());
            self::assertEquals($expected[$index]->country, $customer->getCountry());
            self::assertEquals($expected[$index]->code, $customer->getCode());
            self::assertEquals($expected[$index]->state, $customer->getstate());
        }

    }
}
