@foreach ($posts as $post)                
    <div class="card-body">
        <div>{{ $post->name }}</div>
        <div>{{ $post->content }}</div>
        <div class="form-group row mb-0">
            <div class="col-md-6">
                <a href={{ url("post/edit/$post->id") }} class="btn btn-primary">
                    Edit
                </a>
            </div>
        </div>
    </div>
@endforeach