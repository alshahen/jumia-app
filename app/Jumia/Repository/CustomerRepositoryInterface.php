<?php

namespace App\Jumia\Repository;


use Illuminate\Database\Eloquent\Collection;

interface CustomerRepositoryInterface {
    /**
     * @return Collection
     */
    public function all(): Collection;

}
