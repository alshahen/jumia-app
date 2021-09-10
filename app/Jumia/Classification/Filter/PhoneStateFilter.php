<?php


namespace App\Jumia\Classification\Filter;


class PhoneStateFilter implements FilterInterface
{
    private $state;

    public function __construct($state = null)
    {
        $this->state = $state;
    }

    /**
     * @param $collection
     * @return mixed
     */
    public function apply($collection)
    {
        $state = $this->state;

        if (!empty($state)) {

            $collection = $collection->filter(function ($item) use ($state) {
                if ($state === 'valid' && $item->getState()) {
                    return true;
                }

                if ($state === 'invalid' && !$item->getState()) {
                    return true;
                }

                return false;

            });

        }

        return $collection;
    }

}
