@extends('layouts.master')

@section('content')
    <div class="row">
        {{-- @foreach ($posts as $post)
            <x-post.index :post="$post" />
        @endforeach --}}
        <x-button>
            <x-slot name="title">
                <p>Lorem ipsum dolor sit amet.</p>
            </x-slot>
            <x-slot name="description">
                <p>Lorem ipsum dolor sit amet.</p>
            </x-slot>
            {{-- <p>Lorem ipsum dolor sit amet.</p> --}}
        </x-button>
    </div>
@endsection