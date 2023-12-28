@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Category List</h3>
                <hr>

                <div class="my-3">
                    <a href="{{route('category.create')}}" class="btn btn-dark">Create Category</a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Control</th>
                            <th>Updated At</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>
                                    {{$category->title}}
                                    <br>
                                    <span class="small text-black-50">{{  Str::limit($category->description , 30, '...')  }}</span>
                                </td>

                                <td>{{$category->user->name}}</td>

                                <td>
                                <div class="btn btn-group">

                                    @can('update',$category)
                                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-sm btn-outline-dark">
                                            <i class=" bi bi-pencil"></i>
                                        </a>
                                    @endcan

                                    @can('delete', $category)
                                        <button form="categoryDeleteForm{{$category->id}}" class="btn btn-sm btn-outline-dark">
                                            <i class=" bi bi-trash3"></i>
                                        </button>
                                    @endcan

                                </div>
                                <form id="categoryDeleteForm{{$category->id}}" class=" d-inline-block" action="{{ route("category.destroy",$category->id) }}" method="post">
                                    @method("delete")
                                    @csrf
                                </form>
                                </td>
                                <td>
                                    <p class="small mb-0">
                                        <i class="bi bi-calendar"></i>
                                        {{$category->updated_at->format("d M Y")}}
                                    </p>
                                    <p class="small mb-0">
                                        <i class="bi bi-clock"></i>
                                        {{$category->updated_at->format("h:i a")}}
                                    </p>
                                </td>
                                <td>
                                    <p class="small mb-0">
                                        <i class="bi bi-calendar"></i>
                                        {{$category->created_at->format("d M Y")}}
                                    </p>
                                    <p class="small mb-0">
                                        <i class="bi bi-clock"></i>
                                        {{$category->created_at->format("h:i a")}}
                                    </p>
                                </td>
                            </tr>
                       @empty
                            <tr>
                                <td colspan="6" class=" text-center py-4">
                                    <p>
                                        No category Available
                                    </p>
                                    <a href="{{ route("category.create") }}" class=" btn btn-dark">Create Category</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <div class="">
                    {{$categories->links()}}
                </div> --}}
            </div>
        </div>
    </div>
@endsection
