@extends('layouts.public')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies</div>
                <div class="card-body">
                    @php
                        //dd($companies)
                    @endphp

                    <!-- text end alligns to the right -->
                    <h1 class="text-end">
                        <a href="/categories/create" class="btn btn-info" role="button">
                        + Add New
                        </a>
                    </h1>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                            
                                <td>
                                   
                                    <div style="float:left;">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    </div>
                                    <div style="float:left; margin-left:5px;">
                                        <form method="post" action="/categories/{{ $category->id }}"
                                            onsubmit="return confirm('Delete Category? Are you sure?')"
                                        >
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE"/>
                                            <input type="submit" name="submit" value="Delete" 
                                                   class="btn btn-sm btn-danger btn-block"/>
                                        </form>
                                    </div>
                                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div><!-- .col-md-8 -->
    </div>
</div>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection