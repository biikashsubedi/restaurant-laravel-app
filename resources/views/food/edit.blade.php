@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Manage Food Category</div>

                    <div class="card-body">
                        @if(Session::has('msg'))
                            <div class="alert alert-success">
                                {{Session::get('msg')}}
                            </div>
                        @endif

                        <form action="{{route('food.update', [$food->id])}}" method="post">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <label for="name"><strong>Name</strong></label>
                                <input type="text" name="name" value="{{$food->name}}" placeholder="Enter Food Name.."
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name"><strong>Description</strong></label>
                                <input type="text" name="description" value="{{$food->description}}"
                                       placeholder="Enter Description.."
                                       class="form-control @error('description') is-invalid @enderror">
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name"><strong>Price</strong></label>
                                <input type="text" name="price" value="{{$food->price}}"
                                       placeholder="Choose The Price.."
                                       class="form-control @error('price') is-invalid @enderror">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name"><strong>Image</strong></label>
                                <input type="file" name="image" placeholder="Enter Food Name.."
                                       class="form-control">
{{--                                @error('image')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
                            </div>
                            <div class="form-group">
                                <label for="name"><strong>Category</strong></label>
                                <select name="category_id" id=""
                                        class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="">{{$category->name}}</option>
                                        <option value="{{$category->id}}"
                                                @if($category->id == $food->category_id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-outline"> Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
