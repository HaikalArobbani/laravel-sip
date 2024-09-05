@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Edit Product
                    </h3>
                </div>
                {!! Form::model($product, ['route' => ['product.update', $product->id], 'method' => 'put', 'files' => true, 'id' => 'my-form'], ) !!}
                <div class="card-body">
                  @if (!empty($errors->all()))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('category_id', 'Category') !!}
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Choose Category']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name...']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('price', 'Price') !!}
                            {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price...']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('sku', 'SKU') !!}
                            {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'SKU...']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('image', 'Image') !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', [null => 'Choose Status', 'Active' => 'Active', 'Inactive' => 'Inactive'], null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary float-right">Update Product</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

<script>
    document.onkeydown=function(){
    if(window.event.keyCode=='13'){
        $('#my-form').submit();
    }
}
</script>
