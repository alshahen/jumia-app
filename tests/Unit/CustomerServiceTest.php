<?php

namespace Tests\Unit;

use App\Jumia\Repository\Eloquent\CustomerRepository;
use App\Jumia\Service\CustomerService;
use App\Models\Customer;
use Database\Seeders\CustomerSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CustomerServiceTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_customer_service_without_filter()
    {
        $this->seed(CustomerSeeder::class);

        $customers = new CustomerRepository(new Customer());
        $result = CustomerService::getCustomers($customers, (object)['country' => null , 'state' => null])->transform(function ($customer){
            return $customer->toArray();
        });

        $expected = collect([
            (object)[ 'name' => 'walid hammadi', 'phone' => '6007989253', 'country' => 'morocco', 'state' => false, 'code' => '212'],
            (object)[ 'name' => 'yosaf karrouch', 'phone' => '698054317', 'country' => 'morocco', 'state' => true, 'code' => '212'],
            (object)[ 'name' => 'tanvi sachdeva', 'phone' => '84330678235', 'country' => 'mozambique', 'state' => false, 'code' => '258'],
            (object)[ 'name' => 'filimon embaye', 'phone' => '914701723', 'country' => 'ethiopia', 'state' => true, 'code' => '251'],
            (object)[ 'name' => 'ogwal david', 'phone' => '7771031454', 'country' => 'uganda', 'state' => false, 'code' => '256'],
            (object)[ 'name' => 'arreymanyor roland tabot', 'phone' => '6A0311634', 'country' => 'cameroon', 'state' => false, 'code' => '237'],
            (object)[ 'name' => 'sugar starrk barragan', 'phone' => '6780009592', 'country' => 'cameroon', 'state' => false, 'code' => '237'],
        ]);

        foreach ($result->values() as $index => $customer){
            self::assertIsArray($customer);
            self::assertEquals($expected[$index]->name, $customer['name']);
            self::assertEquals($expected[$index]->phone, $customer['phone']);
            self::assertEquals($expected[$index]->country, $customer['country']);
            self::assertEquals($expected[$index]->code, $customer['code']);
            self::assertEquals($expected[$index]->state, $customer['state']);
        }

    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_customer_service_with_country_filter()
    {
        $this->seed(CustomerSeeder::class);

        $customers = new CustomerRepository(new Customer());
        $result = CustomerService::getCustomers($customers, (object)['country' => 'morocco' , 'state' => null])->transform(function ($customer){
            return $customer->toArray();
        });

        $expected = collect([
            (object)[ 'name' => 'walid hammadi', 'phone' => '6007989253', 'country' => 'morocco', 'state' => false, 'code' => '212'],
            (object)[ 'name' => 'yosaf karrouch', 'phone' => '698054317', 'country' => 'morocco', 'state' => true, 'code' => '212']
        ]);

        foreach ($result->values() as $index => $customer){
            self::assertIsArray($customer);
            self::assertEquals($expected[$index]->name, $customer['name']);
            self::assertEquals($expected[$index]->phone, $customer['phone']);
            self::assertEquals($expected[$index]->country, $customer['country']);
            self::assertEquals($expected[$index]->code, $customer['code']);
            self::assertEquals($expected[$index]->state, $customer['state']);
        }

    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_customer_service_with_state_filter()
    {
        $this->seed(CustomerSeeder::class);

        $customers = new CustomerRepository(new Customer());
        $result = CustomerService::getCustomers($customers, (object)['country' => null , 'state' => 'valid'])->transform(function ($customer){
            return $customer->toArray();
        });

        $expected = collect([
            (object)[ 'name' => 'yosaf karrouch', 'phone' => '698054317', 'country' => 'morocco', 'state' => true, 'code' => '212'],
            (object)[ 'name' => 'filimon embaye', 'phone' => '914701723', 'country' => 'ethiopia', 'state' => true, 'code' => '251'],
        ]);

        foreach ($result->values() as $index => $customer){
            self::assertIsArray($customer);
            self::assertEquals($expected[$index]->name, $customer['name']);
            self::assertEquals($expected[$index]->phone, $customer['phone']);
            self::assertEquals($expected[$index]->country, $customer['country']);
            self::assertEquals($expected[$index]->code, $customer['code']);
            self::assertEquals($expected[$index]->state, $customer['state']);
        }

    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_customer_service_with_country_and_state_filter()
    {
        $this->seed(CustomerSeeder::class);

        $customers = new CustomerRepository(new Customer());
        $result = CustomerService::getCustomers($customers, (object)['country' => 'morocco' , 'state' => 'valid'])->transform(function ($customer){
            return $customer->toArray();
        });

        $expected = collect([
            (object)[ 'name' => 'yosaf karrouch', 'phone' => '698054317', 'country' => 'morocco', 'state' => true, 'code' => '212'],
        ]);

        foreach ($result->values() as $index => $customer){
            self::assertIsArray($customer);
            self::assertEquals($expected[$index]->name, $customer['name']);
            self::assertEquals($expected[$index]->phone, $customer['phone']);
            self::assertEquals($expected[$index]->country, $customer['country']);
            self::assertEquals($expected[$index]->code, $customer['code']);
            self::assertEquals($expected[$index]->state, $customer['state']);
        }

    }
}
