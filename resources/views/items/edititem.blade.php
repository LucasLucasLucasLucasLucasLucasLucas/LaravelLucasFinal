@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Item</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="/items/{{ $item->id }} ">
                            @csrf
                            <label for="category_id">Category: </label>
                            <!-- You can either do old cmd , post, or store the actual category. Old seems like the fastest and safest method. -->
                            <!-- Foreach dropdown-->
                            <select name="category_id" class="form-control" title="category_id">
                                <option value="">Pick a category</option>
                                <!-- REMINDER: use the method we did in the OLD php program for MR, mrs etc.... php inline would work.-->
                                @foreach($categories as $category) 
                                    <option value="{{$category->id}}" <?php if (old('category_id', $item->category_id) == $category->id) echo 'selected';?>> {{$category->category_name}}</option>
                                @endforeach
                            </select>
                            
                            <!-- {{ old('category_name', $category->category_name) }}-->
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" title="title" value="{{old('title', $item->title)}}" />

                            <label for="description">description</label>
                            <input type="text" class="form-control" name="description" title="description" value="{{old('description', $item->description)}}" />

                            <label for="price">price</label>
                            <input type="text" class="form-control" name="price" title="price" value="{{old('price', $item->price)}}" />

                            <label for="quantity">quantity</label>
                            <input type="text" class="form-control" name="quantity" title="quantity" value="{{old('quantity', $item->price)}}" />

                            <label for="sku">sku</label>
                            <input type="text" class="form-control" name="sku" title="sku" value="{{old('sku', $item->sku)}}" />
                            
                            <!-- Picture will be edited-->
                            <label for="picture">picture</label>
                            <input type="file" class="form-control" name="picture" title="picture" />
                            
                            <input type="submit" value="Add item" class="btn btn-primary btn-lg btn-block" style="margin-top:20px">
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