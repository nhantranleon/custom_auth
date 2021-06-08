@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset("css/app.css") }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div>
                    <a href={{ route('post.create') }} class="btn btn-primary">
                        Create new post
                    </a>
                    <a href="{{ route('post.export') }}">Export CSV</a>
                </div>
                <div class="card-header">Posts List</div>
                    <form id="frmSearch" method="GET" action={{ route('post', []) }} data-page={{ \Request::get('page') }}>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6 frmSearch">
                                <input id="name" oninput="autoComplete(this, 'name')" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ \Request::get('name') ?? "" }}" autocomplete="off" autofocus>
                                <div class="suggesstion-box"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">Content</label>

                            <div class="col-md-6 frmSearch">
                                <input id="content" oninput="autoComplete(this, 'content')" type="content" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ \Request::get('content') ?? "" }}" autocomplete="off">
                                <div class="suggesstion-box"></div>
                            </div>
                        </div>
                        @if (empty(request()->has("page")))
                            <input class="" style="display: none" name="page" value="{{ request()->get("page") }}">
                        @endif
                        @if (!empty(request()->has("orderByType")))
                            <input class="" style="display: none" name="orderByType" value="{{ request()->get("orderByType") }}">
                            <input class="" style="display: none" name="orderBy" value="{{ request()->get("orderBy") }}">
                        @endif
                        <button type="submit" class="btn btn-primary">Search Field</button>
                    </form>

                    <div>
                        <table id="post-list">
                            <tr>
                                <th>Id</th>
                                <th class="column-name">Name</th>
                                <th class="column-content">Content</th>
                                <th></th>
                            </tr>
                        @foreach ($posts as $key=>$post)
                            <tr class="table-content">
                                <td>{{ $posts->perPage()*($posts->currentPage() - 1) + $key + 1 }}</td>
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->content }}</td>
                                <td>
                                    <div class="col-md-6">
                                        <a href={{ url("post/edit/$post->id") }} class="btn btn-primary">
                                            Edit
                                        </a>
                                        <form id="delete-post" method="POST" action="{{ route('post.delete', $post->id) }}">
                                            @csrf
                                            <button class="btn btn-primary">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </table>
                        {{ $posts->links('vendor.pagination.custom') }}
                    </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/post/index.js') }}"></script>
@endsection