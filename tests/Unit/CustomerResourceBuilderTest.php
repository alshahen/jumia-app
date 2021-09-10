<?php

namespace Tests\Unit;

use App\Jumia\Resource\Customer\CustomerResource;
use App\Jumia\Validator\Rules\CountryPhoneNumberValidator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerResourceBuilderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_customer_resource_builder()
    {

        $dummyCustomers = collect([
            (object)[ 'name' => 'Walid Hammadi', 'phone' => '(212) 6007989253'],
            (object)[ 'name' => 'Yosaf Karrouch', 'phone' => '(212) 698054317'],
            (object)[ 'name' => 'Tanvi Sachdeva', 'phone' => '(258) 84330678235'],
            (object)[ 'name' => 'Filimon Embaye', 'phone' => '(251) 914701723'],
            (object)[ 'name' => 'Ogwal David', 'phone' => '(256) 7771031454'],
            (object)[ 'name' => 'ARREYMANYOR ROLAND TABOT', 'phone' => '(237) 6A0311634'],
            (object)[ 'name' => 'SUGAR STARRK BARRAGAN', 'phone' => '(237) 6780009592'],
        ]);

        foreach ($dummyCustomers->all() as $customer){
            $result[] = (new \App\Jumia\Builder\CustomerResourceBuilder\CustomerResourceBuilder(new CustomerResource()))
                ->name($customer->name)
                ->country($customer->phone)
                ->phone($customer->phone)
                ->phoneState(new CountryPhoneNumberValidator($customer->phone))
                ->build();
        }

        $expected = collect([
            (object)[ 'name' => 'walid hammadi', 'phone' => '6007989253', 'country' => 'morocco', 'state' => false, 'code' => '212'],
            (object)[ 'name' => 'yosaf karrouch', 'phone' => '698054317', 'country' => 'morocco', 'state' => true, 'code' => '212'],
            (object)[ 'name' => 'tanvi sachdeva', 'phone' => '84330678235', 'country' => 'mozambique', 'state' => false, 'code' => '258'],
            (object)[ 'name' => 'filimon embaye', 'phone' => '914701723', 'country' => 'ethiopia', 'state' => true, 'code' => '251'],
            (object)[ 'name' => 'ogwal david', 'phone' => '7771031454', 'country' => 'uganda', 'state' => false, 'code' => '256'],
            (object)[ 'name' => 'arreymanyor roland tabot', 'phone' => '6A0311634', 'country' => 'cameroon', 'state' => false, 'code' => '237'],
            (object)[ 'name' => 'sugar starrk barragan', 'phone' => '6780009592', 'country' => 'cameroon', 'state' => false, 'code' => '237'],
        ]);

        self::assertEquals(count($result), $expected->count());

        foreach ($result as $index => $customer){
            self::assertInstanceOf(CustomerResource::class, $customer);
            self::assertEquals($expected[$index]->name, $customer->getName());
            self::assertEquals($expected[$index]->phone, $customer->getPhone());
            self::assertEquals($expected[$index]->country, $customer->getCountry());
            self::assertEquals($expected[$index]->code, $customer->getCode());
            self::assertEquals($expected[$index]->state, $customer->getstate());
        }


    }


}
