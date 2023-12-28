@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Article List</h3>
                <hr>

                <div class="my-3">
                    <a href="{{route('article.create')}}" class="btn btn-dark">Create post</a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Article</th>
                            <th>Category</th>
                            @can('admin-only')
                                <th>Owner</th>
                            @endcan
                            <th>Control</th>
                            <th>Updated At</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            <tr>
                                <td>{{$article->id}}</td>
                                <td>
                                    {{$article->title}}
                                    <br>
                                    <span class="small text-black-50">{{  Str::limit($article->description , 30, '...')  }}</span>
                                </td>
                                <td>
                                    {{-- {{$article->category?->title}} --}}
                                    {{$article->category->title ?? "Unknown" }}
                                </td>
                                @can('admin-only')
                                    <td>{{$article->user->name}}</td>
                                @endcan
                                <td>
                                <div class="btn btn-group">
                                    <a href="{{ route('article.show',$article->id) }}" class=" btn btn-sm btn-outline-dark">
                                        <i class=" bi bi-info"></i>
                                    </a>
                                    @can('update',$article)
                                        <a href="{{ route('article.edit',$article->id) }}" class="btn btn-sm btn-outline-dark">
                                            <i class=" bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('delete',$article)
                                        <button form="articleDeleteForm{{$article->id}}" class="btn btn-sm btn-outline-dark">
                                            <i class=" bi bi-trash3"></i>
                                        </button>
                                    @endcan
                                </div>
                                <form id="articleDeleteForm{{$article->id}}" class=" d-inline-block" action="{{ route("article.destroy",$article->id) }}" method="post">
                                    @method("delete")
                                    @csrf
                                </form>
                                </td>
                                <td>
                                    <p class="small mb-0">
                                        <i class="bi bi-calendar"></i>
                                        {{$article->updated_at->format("d M Y")}}
                                    </p>
                                    <p class="small mb-0">
                                        <i class="bi bi-clock"></i>
                                        {{$article->updated_at->format("h:i a")}}
                                    </p>
                                </td>
                                <td>
                                    <p class="small mb-0">
                                        <i class="bi bi-calendar"></i>
                                        {{$article->created_at->format("d M Y")}}
                                    </p>
                                    <p class="small mb-0">
                                        <i class="bi bi-clock"></i>
                                        {{$article->created_at->format("h:i a")}}
                                    </p>
                                </td>
                            </tr>
                       @empty
                            <tr>
                                <td colspan="7" class=" text-center py-4">
                                    <p>
                                        No article Available
                                    </p>
                                    <a href="{{ route("article.create") }}" class=" btn btn-dark">Create Category</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="">
                    {{$articles->onEachSide(1)->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
