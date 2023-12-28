@extends('layouts.master')

@section('content')

                @if (request()->has('keyword'))
                    <div class="d-flex justify-content-between">
                        <h5 class=" mb-2">Showing results for '<span class="fw-bold">{{request()->keyword}}</span>'</h5>
                        <a href="{{route('index')}}" class="text-dark"><span>cancel</span></a>
                    </div>
                @endif
                @forelse ($articles as $article)
                    <div class=" card mb-3">
                        <div class="card-body">
                            <h3 class="mb-2">
                                <a href="{{ route('detail',$article->slug) }}" class=" text-decoration-none text-dark mb-0">
                                {{ $article->title }}
                                </a>
                            </h3>
                            <div class="mb-4">
                                <span class=" badge bg-dark">{{ $article->category->title ?? "unknown" }}</span>
                                <span class=" badge bg-dark">{{ $article->created_at->format('d M Y') }}</span>
                                <span class=" badge bg-dark">{{ $article->user->name }}</span>
                            </div>
                            <div class="mb-3">{{ $article->excerpt }}</div>
                            <a href="{{ route('detail',$article->slug) }}" class="btn btn-dark btn-sm">Read more</a>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body text-center">
                            <h3>There is no article available.</h3>
                            <a href="{{route('register')}}" class="btn btn-dark">Register Now</a>
                        </div>
                    </div>
                @endforelse
                <div class="">
                    {{$articles->onEachSide(1)->links()}}
                </div>


            {{-- <div class="col-lg-4">
                @include('layouts.sidebar')
            </div> --}}


@endsection
