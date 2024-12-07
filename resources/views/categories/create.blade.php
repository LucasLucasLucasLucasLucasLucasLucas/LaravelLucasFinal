@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a Category</div>
                    <div class="card-body">

                        <form method="POST" action="/categories">
                            @csrf
                            <label for="category">Category</label>
                            <!-- You can either do old cmd , post, or store the actual category. Old seems like the fastest and safest method. -->
                            <input type="text" class="form-control" name="categories" title="categories" value="{{old('categories')}}" />
                            <input type="submit" value="Add Category" 
                                   class="btn btn-primary btn-lg btn-block" style="margin-top:20px">
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