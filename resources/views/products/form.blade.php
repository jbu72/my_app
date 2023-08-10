@extends('layouts.app')

@section('title', 'Form products')

@section('contents')
<form action="{{ isset($product) ? route('products.update', $product->id) : route('products.save') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form plus product</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="item_code">Code product</label>
                        <input type="text" class="form-control" id="item_code" name="item_code" value="{{ isset($product) ? $product->item_code : '' }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" >
                    </div>

                    <div class="form-group">
                        <label for="productname">Name product</label>
                        <input type="text" class="form-control" id="productname" name="productname" value="{{ isset($product) ? $product->productname : '' }}">
                    </div>

                    <div class="form-group">
                        <label for="categoryId">Category product</label>
                        <select name="categoryId" id="categoryId" class="custom-select">
                            <option value="" selected disabled hidden>-- Choose Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ (isset($product) && $product->category_id == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Price product</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ isset($product) ? $product->price : '' }}">
                    </div>

                    <div class="form-group">
                        <label for="details">Détails du produit</label>
                        <textarea class="form-control" id="details" name="details" rows="4"></textarea>
                    </div>


                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
