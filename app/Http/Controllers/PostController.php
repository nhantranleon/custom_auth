<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepositoryInterface;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    //
    public function index(Request $request) 
    {
        return view('post.index', ['posts' => $this->postRepository->showPosts($request->name ?? "", $request->content ?? "", $request->orderBy ?? "id", $request->orderByType ?? "DESC")]);
    }

    
    public function store(PostRequest $request)
    {
        $this->postRepository->create([
            'name' => $request->name,
            'content' => $request->content
        ]);

        return redirect('/post');
    }

    public function create() 
    {
        return view('post.create');
    }

    public function edit(Request $request)
    {   
        return view('post.edit', ['post' => $this->postRepository->find($request->id)]);
    }

    public function update(PostRequest $request)
    {
        $update = $this->postRepository->update($request->id, [
            "name" => $request->name,
            "content" => $request->content
        ]);

        if($update) {
            return redirect('/post');
        }

        return redirect(Request::url());
    }

    public function filter(Request $request)
    {
        $post = $this->postRepository->filterPostListByAjax($request["name"], $request["content"], $request["orderBy"], $request["orderByType"]);
        $returnHTML = view('post.partial-post')->with('posts', $post)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function destroy(Request $request)
    {
        $post = $this->postRepository->find($request->id);
        $post->delete();

        return redirect('/post');
    }

    /**
     * make auto complete for post field search 
     * @param Request $request
     * @return response
     */
    public function autoSearch(Request $request)
    {
        $list = $this->postRepository->searchField($request["type"], $request["value"]??"");
        $returnHTML = view('post.autocompleteField')->with(['list' => $list])->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    /**
     * export list post CSV
     * @param Request $request
     * @return mixed
     */
    public function exportCsv(Request $request)
    {
        $fileName = 'posts.csv';
        $posts = $this->postRepository->all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Id', 'Name', 'Content', 'Created Date', 'Updated Date');

        $callback = function() use($posts, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($posts as $key=>$post) {
                $row['Id']  = $key+1;
                $row['Name']    = $post->name;
                $row['Content']    = $post->content;
                $row['Created Date']  = $post->created_at;
                $row['Updated Date']  = $post->udpated_at;

                fputcsv($file, array($row['Id'], $row['Name'], $row['Content'], $row['Created Date'], $row['Updated Date']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
