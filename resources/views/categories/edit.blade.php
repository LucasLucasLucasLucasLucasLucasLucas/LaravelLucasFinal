@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Category</div>
                    <div class="card-body">
                        <form method="POST" action="/categories/{{ $category->id }}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH"/>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="category_name">Category</label>
                                    <input type="text" class="form-control" name="category_name" title="category_name" value="{{ old('category_name', $category->category_name) }}"/>
                            
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="/categories" class="btn btn-lg btn-danger btn-block" style="margin-top:20px">Cancel</a>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" value="Save Category" class="btn btn-success btn-lg btn-block" style="margin-top:20px">
                                </div>
                            </div>

                            
                        </form>

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