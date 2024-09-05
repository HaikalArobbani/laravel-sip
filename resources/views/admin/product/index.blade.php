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
                    <a href="{{ route('product.create') }}" class="btn btn-tool">
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

                {!! Form::open(['route' => 'product.index', 'method' => 'GET']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('category', 'Category') !!}
                            {!! Form::select('category', $categories, $category, ['class' => 'form-control',
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

                {!! Form::close() !!}
                <div class="btn-group" role="group" aria-label="Button group">
                    <a href="{{route('product.export' )}}"
                        class="btn btn-sm btn-info" style="color: #fff"><i
                            class="fa fa-table"> Download Excel</i>
                        </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>SKU</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $key => $value)
                            <tr>
                                <td>{{ ($product->currentPage() - 1) * $product->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $value->categories->name}}</td>
                                <td>{{ $value->name}}</td>
                                <td>{!! $value->price ()   !!}</td>
                                <td>{{ $value->sku}}</td>
                                <td><img src="{{ $value->showImage() }}" alt="{{ $value->showImage() }}" width="100px"></td>
                                <td>{{ $value->description }}</td>
                                <td>{!! $value->printStatus ()   !!}</td>
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
                        {{ $product->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
