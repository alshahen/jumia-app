<?php
namespace App\Jumia\Repository\Eloquent;


use App\Models\Customer;
use App\Jumia\Repository\CustomerRepositoryInterface;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

}
