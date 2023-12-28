@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Article Details</h3>
                <hr>

                <div class="my-3">
                    <a href="{{route('article.create')}}" class="btn btn-dark">Create post</a>
                    <a href="{{route('article.index')}}" class="btn btn-dark">Article List</a>
                </div>

                <div class="">
                    <h4>{{ $article->title }}</h4>
                    <div class="">
                        {{ $article->description }}

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


