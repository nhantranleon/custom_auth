<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    /**
     * Filter Post collection by name and content function 
     *
     * @param [string] $namePostFilter
     * @param [string] $contentPostFilter
     * @return Collection
     */
    public function filterPostListByAjax($namePostFilter, $contentPostFilter): Collection;
}