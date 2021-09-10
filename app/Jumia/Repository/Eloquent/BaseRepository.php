<?php
namespace App\Jumia\Repository\Eloquent;

use App\Jumia\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @props Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param $create
     * @return Collection
     */
    public function create($create): Collection
    {
        return $this->model::create($create);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model::all();
    }

}
