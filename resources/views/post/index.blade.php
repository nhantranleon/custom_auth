@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts List</div>
                    <form method="POST" action="{{ route('post.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">Content</label>

                            <div class="col-md-6">
                                <input id="content" type="content" class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content">
                            </div>
                        </div>
                    </form>
                    <div id="post-list">
                        @foreach ($posts as $post)
                            
                            <div class="card-body">
                                <div>{{ $post->name }}</div>
                                <div>{{ $post->content }}</div>
                                <div class="form-group row mb-0">
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <a href={{ route('post.create') }} class="btn btn-primary">
                            Create new post
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
    var ajaxurl ='{{route('post.filter')}}';
    $('#name, #content').on('input', function(){
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: $('form').serializeArray(),
            success: function(data){
                $('#post-list').empty().append($(data.html));

            }
        })
    });
</script>

@endsection