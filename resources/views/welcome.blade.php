@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Products Manage') }}</div>

                <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Details</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->details}}</td>
                                        <td>{{$product->price}}</td>
                                        
                                        <td>
                                            <a href="" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{ $products->links() }}
                                </tbody>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
