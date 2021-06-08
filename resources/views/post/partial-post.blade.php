@foreach ($posts as $key=>$post)                
    <tr class="table-content">
        <td>{{ $key+1 }}</td>
        <td>{{ $post->name }}</td>
        <td>{{ $post->content }}</td>
        <td>
            <div class="col-md-6">
                <a href={{ url("post/edit/$post->id") }} class="btn btn-primary">
                    Edit
                </a>
                <form method="POST" action="{{ route('post.delete', $post->id) }}">
                    @csrf
                    <button class="btn btn-primary">
                        Delete
                    </button>
                </form>
            </div>
        </td>
    </tr>
@endforeach