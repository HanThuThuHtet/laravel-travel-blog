@extends("layouts.app")
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Edit article</h3>
                <hr>
                <form action="{{route('article.update',$article->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="" class=" form-label">Article Title</label>
                        <input type="text " class="form-control
                        @error('title')
                            is-invalid
                        @enderror"  value="{{old('title',$article->title)}}" name="title">
                        @error('title')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class=" form-label">Select Category</label>

                        <select  class="form-select
                        @error('category')
                            is-invalid
                        @enderror" value="{{old('category')}}" name="category">
                            @foreach (App\Models\Category::all() as $category)
                                <option
                                    value="{{$category->id}}"
                                    {{ old('category',$article->category_id) == $category->id ? 'selected' : "" }}
                                    >
                                        {{$category->title}}
                                </option>
                            @endforeach
                        </select>

                        @error('category')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class=" form-label">Description</label>
                        <textarea  class="form-control
                        @error('description')
                            is-invalid
                        @enderror" name="description" rows="7">{{ old('description',$article->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection
