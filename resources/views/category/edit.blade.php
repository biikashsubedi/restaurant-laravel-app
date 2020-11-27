@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Manage Food Category</div>

                    <div class="card-body">

                        <form action="{{route('category.update', [$category->id])}}" method="post">
                            {{method_field('PUT')}}
                            @csrf
                            <div class="form-group">
                                <label for="name">name</label>
                                <input type="text" name="name" placeholder="Enter Category Name.."
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{$category->name}}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-outline"> Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
