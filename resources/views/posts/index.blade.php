@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>All post</h6>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                @can("create", \App\Model\Post::class)
                                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success me-2">Create</a>
                                    <a href="{{ route('posts.trash') }}" class="btn btn-sm btn-warning">Trashed</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" width="10%">Image</th>
                                    <th scope="col" width="20%">Title</th>
                                    <th scope="col" width="30%">Description</th>
                                    <th scope="col" width="10%">Category</th>
                                    <th scope="col" width="10%">Publish Date</th>
                                    <th scope="col" width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($posts as $key => $post)         
                                    <tr>
                                        <th scope="row">{{ $post->id }}</th>
                                        <td>
                                            <img src="{{ asset($post->image) }}" alt="" width="60">
                                        </td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->description }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td>{{ $post->created_at->format('Y-m-d h:i:s a') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-success me-2">Show</a>
                                                @can("update", $post)
                                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                                                @endcan

                                                @can("delete", $post)                  
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
