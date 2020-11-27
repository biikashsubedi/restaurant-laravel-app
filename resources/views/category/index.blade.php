@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Listed Category</div>

                    <div class="card-body">
                        @if(Session::has('msg'))
                            <div class="alert alert-success">
                                {{Session::get('msg')}}
                            </div>
                        @endif

                        <table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col"><strong>S.N.</strong></th>
                                <th scope="col"><strong>Category Name</strong></th>
                                <th scope="col"><strong>Action1</strong></th>
                                <th scope="col"><strong>Action2</strong></th>
                            </tr>
                            </thead>
                            @if(count($categories)>0)
                                @foreach($categories  as $key=>$category)
                                    <tbody>
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <a href="{{route('category.edit', [$category->id])}}">
                                                <button class="btn btn-outline-success">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                    data-target="#exampleModal{{$category->id}}">
                                                Delete
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="color: lime">
                                                        <form action="{{route('category.destroy', [$category->id])}}"
                                                              method="post">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-center" id="exampleModalLabel"> This
                                                                    Action can Delete <strong>"{{$category->name}}
                                                                        "</strong> Category!!!</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are You Sure, Want to Delete?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-success"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-danger">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            @else
                                <p><strong>No category to display</strong></p>
                            @endif

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
