@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transaction') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            
                    {{-- <div class="my-2">
                        <a href="{{url('transaction/create')}}" class="btn btn-success btn-icon-split">  
                            <span class="text">Tambah Data</span>
                        </a>       
                    </div> --}}
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Reference No</th>
                                    <th>Name Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            @foreach ($data as $dt)
                            <tbody>

                                <tr>
                                    <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                                    <td>{{$dt->reference_no}}</td>
                                    <td>{{$dt->product->name}}</td>
                                    <td>{{$dt->price}}</td>
                                    <td>{{$dt->qty}}</td>
                                    <td>{{$dt->payment_amount}}</td>
                                    {{-- <td>
                                        <a href="{{ url('transaction/delete/'.$dt->id) }}" class="btn btn-danger mb-2">  
                                            <i class="fa fa-times"></i>
                                            Hapus
                                        </a>

                                    </td> --}}
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