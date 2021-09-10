<?php
namespace App\Jumia\Service;


use App\Jumia\Builder\CustomerResourceBuilder\CustomerResourceBuilder;
use App\Jumia\Classification\CollectionClassification;
use App\Jumia\Classification\Filter\CountryFilter;
use App\Jumia\Classification\Filter\PhoneStateFilter;
use App\Jumia\Repository\CustomerRepositoryInterface;
use App\Jumia\Resource\Customer\CustomerResource;
use App\Jumia\Validator\Rules\CountryPhoneNumberValidator;
use Illuminate\Support\Collection;


class CustomerService
{
    /**
     * @param CustomerRepositoryInterface $customers
     * @param Object $filter
     * @return Collection|null
     */
    public static function getCustomers(CustomerRepositoryInterface $customers, Object $filter): ?Collection
    {
        foreach ($customers->all() as $customer){
            $customerResource[] = (new CustomerResourceBuilder(new CustomerResource()))
                ->name($customer->name)
                ->country($customer->phone)
                ->phone($customer->phone)
                ->phoneState(new CountryPhoneNumberValidator($customer->phone))
                ->build();
        }

        return (new CollectionClassification($customerResource ?? null))
            ->classifiedBy(new CountryFilter($filter->country))
            ->classifiedBy(new PhoneStateFilter($filter->state))
            ->getCollection();

    }
}
