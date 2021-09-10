<?php


namespace App\Jumia\Classification\Filter;


class CountryFilter implements FilterInterface
{
    private $country;

    public function __construct($country = null)
    {
        $this->country = $country;
    }

    /**
     * @param $collection
     * @return mixed
     */
    public function apply($collection)
    {
        $country = $this->country;

        if (!empty($country)) {
            $collection = $collection->filter(function ($customer) use ($country) {
                return $customer->getCountry() === strtolower($country);
            });
        }

        return $collection;
    }
}
