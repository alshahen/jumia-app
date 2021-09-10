<?php


namespace App\Jumia\Classification;

use App\Jumia\Classification\Filter\FilterInterface;

class CollectionClassification implements ClassificationInterface
{
    private $collection;

    public function __construct(?array $collection)
    {
        $this->collection = collect($collection);
    }

    /**
     * @param FilterInterface $filter
     * @return CollectionClassification
     */
    public function classifiedBy(FilterInterface $filter): CollectionClassification
    {
        $this->collection = $filter->apply($this->collection);

        return $this;
    }

    public function getCollection(): \Illuminate\Support\Collection
    {
        return $this->collection;
    }
}
