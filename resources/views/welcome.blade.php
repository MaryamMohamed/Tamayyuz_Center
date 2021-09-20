@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p class="btn-holder"><a href="{{ route('indexProduct') }}" class="btn btn-warning btn-block text-center" role="button">View Products</a> </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
