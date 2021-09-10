<?php


namespace App\Jumia\Builder\CustomerResourceBuilder;

use App\Jumia\Resource\Customer\CustomerResource;
use App\Jumia\Resource\Customer\CustomerResourceInterface;
use App\Jumia\Validator\ValidatorInterface;

class CustomerResourceBuilder implements CustomerResourceBuilderInterface
{

    private CustomerResourceInterface $customer;


    public function __construct(CustomerResourceInterface $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param string $name
     * @return CustomerResourceBuilder
     */
    public function name(string $name): CustomerResourceBuilder
    {
        $this->customer->setName($name);

        return $this;
    }

    /**
     * @param string $phone
     * @return CustomerResourceBuilder
     */
    public function country(string $phone): CustomerResourceBuilder
    {

        if (!empty(preg_match_all('/\(([^)]+)\)/', $phone, $code, PREG_SET_ORDER, 0)))
        {
            $country = '';
            $countryCode = '';

            foreach (config('country_patterns') as $countryName => $countryPattern){
                if ($countryPattern['code'] === $code[0][1]) {
                    $country = $countryName;
                    $countryCode = $countryPattern['code'];
                }
            }

            $this->customer->setCountry($country);

            $this->customer->setCode($countryCode);

        }

        return $this;
    }

    /**
     * @param string $phone
     * @return CustomerResourceBuilder
     */
    public function phone(string $phone): CustomerResourceBuilder
    {
        $phone = preg_replace('/\(([^)]+)\)/', '', $phone, 1);

        if (!empty($phone)) {
            $this->customer->setPhone(trim($phone));
        }
        else {
            $this->customer->setPhone('');
        }

        return $this;
    }

    /**
     * @param ValidatorInterface $validator
     * @return CustomerResourceBuilder
     */
    public function phoneState(ValidatorInterface $validator): CustomerResourceBuilder
    {
        $this->customer->setState($validator->validate());

        return $this;
    }

    /**
     * @return CustomerResource
     */
    public function build(): CustomerResource
    {
        return $this->customer;
    }




}
