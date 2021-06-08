<?php

namespace App\Repositories\Redis;
use App\Models\Post;

use Illuminate\Support\Facades\Redis;
use App\Repositories\Contracts\PostRepositoryInterface;

class RedisPostRepository implements PostRepositoryInterface
{
    public function all()
    {
        return Post::all();
    }

    public function find($id)
    {
        return Post::find($id);
    }

    public function filterPostListByAjax($postNameFilter, $postContentFilter)
    {
        return Post::where('name', 'like', '%'.$postNameFilter.'%')
            ->where('content', 'like', '%'.$postContentFilter.'%')
            ->get();
    }
}