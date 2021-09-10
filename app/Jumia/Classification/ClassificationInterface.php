<?php


namespace App\Jumia\Classification;


use App\Jumia\Classification\Filter\FilterInterface;

interface ClassificationInterface
{
    public function classifiedBy(FilterInterface $filter);
}
