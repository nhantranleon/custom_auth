<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{
    /**
    * @param array $attributes
    * @return Model
    */

    public function create(array $attributes): Model;

    /**
     * @param $id 
     * @return Model
     */

     public function find($id): ?Model;

    /**
     * @return Collection
     */

     public function all(): ?Collection;

     /**
      * @param number $perPage
     * @return LengthAwarePaginator
     */

    public function paginate($perPage): ?LengthAwarePaginator;
}