<?php

namespace App\Http\Controllers;


use App\Jumia\Repository\Eloquent\CustomerRepository;
use App\Jumia\Service\CustomerService;
use Illuminate\Support\Collection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CustomerRepository $customers
     * @return Collection
     */
    public function index(CustomerRepository $customers): Collection
    {
        return CustomerService::getCustomers($customers, request())->transform(function ($customer){
            return $customer->toArray();
        });

    }

}
