@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Product</a></li>
    </ol>
</div>

<div class="container-fluid">
    @can('show_product')
    <div class="card">
        <div class="card-header">
            <h3>Product List</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>SL</th>
                    <th>Product</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>Preview</th>
                    <th>Thumbnails</th>
                    <th>Action</th>
                </tr>
                @foreach ($products as $key=>$product)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->discount}}%</td>
                    <td>{{ $product->rel_to_cat->category_name }}</td>
                    <td>{{ $product->rel_to_subcat->subcategory_name }}</td>
                    <td><img width="100" src="{{ asset('uploads/product/preview')}}/{{ $product->preview}}" alt=""></td>
                    <td>
                        @foreach (App\Models\Thumbnail::where('product_id', $product->id)->get() as $thumbnail)
                             <img width="50" src="{{ asset('uploads/product/thumbnail') }}/{{ $thumbnail->thumbnail }}" alt="">
                        @endforeach
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('inventory', $product->id) }}">Inventory</a>
                                @can('delete_product')
                                <a class="dropdown-item" href="{{ route('product.delete', $product->id) }}">Delete</a>
                                @endcan
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    @endcan
</div>
@endsection
