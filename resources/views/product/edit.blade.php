@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Data Product') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="p-10">
                        <form method="post" class="user" action="{{ url('product/edit/'.$data['id']) }}">
                            @csrf
                            <div class="form-group">
                                <label for="">Name Product</label>
                                <input type="text" class="form-control"
                                    name="name" placeholder="Name Product" value="{{ $data['name'] }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input type="number" class="form-control"
                                    name="stock" placeholder="Stock" value="{{ $data['stock'] }}"  required>
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control"
                                    name="price" placeholder="Price" value="{{ $data['price'] }}"  required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="">Description</label>
                                <textarea class="form-control" name="description">{{ $data['description'] }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success btn-user btn-block" value="Edit Data">
                                Edit Data
                            </button>
                            <a href="{{ url('product') }}" class="btn btn-secondary btn-user btn-block">
                                Back
                            </a>
                                
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection