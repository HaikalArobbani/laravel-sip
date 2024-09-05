@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-tags"></i> Product
                </h3>
                <div class="card-tools">
                    <a href="{{ route('transaction.create') }}" class="btn btn-tool">
                        <i class="fa fa-plus"></i> Add Product
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check"></i>&nbsp; {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                {{-- {!! Form::open(['route' => 'transaction.index', 'method' => 'GET']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('product', 'Product') !!}
                            {!! Form::select('product', $products, $prod, ['class' => 'form-control',
                            'placeholder' => 'All Category']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('search', 'Search') !!}
                        {!! Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-outline btn-primary" style="margin-top: 6%"><i
                                class="fa fa-search"></i> Cari</button>
                        <a href="{{ route('product.index') }}" class="btn btn-outline btn-secondary"
                            style="margin-top: 6%"><i class="fas fa-sync"></i> Reload</a>
                    </div>
                </div>

                {!! Form::close() !!} --}}
                <div class="table-responsive">
                    <div class="btn-group" role="group" aria-label="Button group">
                        <a href="{{route('transaction.export' )}}"
                            class="btn btn-sm btn-info" style="color: #fff"><i
                                class="fa fa-table"> Download Excel</i>
                            </a>
                    </div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Trx_date</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $key => $value)
                            <tr>
                                <td>{{ ($key+1)}}</td>
                                <td>{{ $value->product->name}}</td>
                                <td>{{ $value->trx_date}}</td>
                                <td>{!! $value->price ()   !!}</td>
                                <td>
                                    <form action="{{route('product.destroy', $value->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <div class="btn-group" role="group" aria-label="Button group">
                                            <a href="{{route('product.show' , $value->id)}}"
                                                class="btn btn-sm btn-info" style="color: #fff"><i
                                                    class="fa fa-eye"></i></a>
                                            <a href="{{route('product.edit' , $value->id)}}"
                                                        class="btn btn-sm btn-success" style="color: #fff"><i
                                                    class="fa fa-edit"></i></a>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin mau hapus data?')" style="color: #fff"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
