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
                                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-success me-2">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>  
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $post->id }}</td>
                                </tr>  
                                <tr>
                                    <td>Image</td>
                                    <td>
                                        <img src="{{ asset($post->image) }}" alt="" width="200">
                                    </td>
                                </tr> 
                                <tr>
                                    <td>Title</td>
                                    <td>{{ $post->title }}</td>
                                </tr> 
                                <tr>
                                    <td>description</td>
                                    <td>{{ $post->description }}</td>
                                </tr> 
                                <tr>
                                    <td>Category</td>
                                    <td>{{ $post->category_id }}</td>
                                </tr> 
                                <tr>
                                    <td>Publish Date</td>
                                    <td>{{ $post->created_at->format('Y-m-d h:i:s a') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
