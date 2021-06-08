<?php
namespace App\Repositories\Eloquents;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{

    /**
    * UserRepository constructor.
    *
    * @param Post $model
    */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
    
    /**
     * Filter Post collection by name and content function
     *
     * @param [string] $postNameFilter
     * @param [string] $postContentFilter
     * @return Collection
     */
    public function filterPostListByAjax($postNameFilter, $postContentFilter): Collection
    {
        return $this->model->where('name', 'like', '%'.$postNameFilter.'%')
            ->where('content', 'like', '%'.$postContentFilter.'%')
            ->get();
    }

    /**
     * auto search field post function
     * @param string $type
     * @param string $value
     * @return array
     */
    public function searchField(string $type, string $value)
    {
        return $this->model->where($type, "like", "%".$value."%")
            ->pluck($type);
    }

    /**
     * @param String $name
     * @param String $content
     * @param String $orderByType
     * @param String $orderBy
     * @return 
     */
    public function showPosts($name, $content, $orderBy, $orderByType)
    {
        return $this->model->where("name", "like", "%{$name}%")
            ->where("content", "like", "%{$content}%")
            ->orderBy($orderBy, $orderByType)
            ->paginate(NUMBER_OF_PERPAGE_POST_LIST);
    }
}