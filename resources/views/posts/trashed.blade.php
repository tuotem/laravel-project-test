@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Trashed post</h6>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-success me-2">Back</a>
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
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>
                                            <img src="{{ asset($post->image) }}" alt="" width="60">
                                        </td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->description }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td>{{ $post->created_at->format('Y-m-d h:i:s a') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('posts.restore', $post->id) }}" class="btn btn-sm btn-warning me-2">Restore</a>
                                                <form action="{{ route('posts.force_delete', $post->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
