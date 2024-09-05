@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Detail Product
                    </h3>
                </div>
                {!! Form::model($product, ['route' => ['product.show', $product->id], 'method' => 'put', 'files' => true]) !!}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('category_id', 'Category') !!}
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Choose Category', 'disabled']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name...', 'disabled']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('price', 'Price') !!}
                            {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price...', 'disabled']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('sku', 'SKU') !!}
                            {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'SKU...', 'disabled']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('image', 'Image') !!}
                            <img src="{{ $product->showImage() }}" class="img-thumbnail" width="100" alt="" srcset="">
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', [null => 'Choose Status', 'Active' => 'Active', 'Inactive' => 'Inactive'], null, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
