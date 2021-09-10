<?php
namespace App\Jumia\Repository;

use Illuminate\Database\Eloquent\Collection;
/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{

    public function create(array $create);
    /**
     * @return Collection
     */
    public function all() : Collection;

}
