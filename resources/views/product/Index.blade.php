@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Produk') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            
                    <div class="my-2">
                        <a href="{{url('product/create')}}" class="btn btn-success btn-icon-split">  
                            <span class="text">Tambah Data</span>
                        </a>       
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name Product</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @foreach ($data as $dt)
                            <tbody>

                                <tr>
                                    <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                                    <td>{{$dt->name}}</td>
                                    <td>{{$dt->description}}</td>
                                    <td>{{$dt->stock}}</td>
                                    <td>{{$dt->price}}</td>
                                    <td>
                                        <a href="{{ url('product/edit/'.$dt->id) }}" class="btn btn-primary mb-2">  
                                            <i class="fa fa-edit"></i>
                                            Edit    
                                        </a>
                                        <a href="{{ url('product/delete/'.$dt->id) }}" class="btn btn-danger mb-2">  
                                            <i class="fa fa-times"></i>
                                            Hapus
                                        </a>

                                    </td>
                                </tr>
                                
                            </tbody>
                            @endforeach
                        </table>
                        Halaman : {{ $data->currentPage() }} <br/>
                        Jumlah Data : {{ $data->total() }} <br/>
                        Data Per Halaman : {{ $data->perPage() }} <br/>
                    
                        {{ $data->links('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection