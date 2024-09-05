@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-tittle">
                    <i class="fa fa-plus"></i> Add Product
                </h3>
            </div>
                @csrf
                {{-- html  collective --}}
                {!! Form::open(['route' => 'product.store', 'files' => true, 'method' => 'POST']) !!}
                <div class="card-body">

                    {{-- handle errors --}}
                    @if(!empty($errors->all()))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row">
                        <div class="form-group col-sm-6">
                        {!! Form::label('category', 'Category') !!}
                        {!! Form::select('category_id', $categories , null, ['class' => 'form-control', 'placeholder' => 'select category']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('name', 'Nama') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('price', 'Price') !!}
                            {!! Form::number('price', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('sku', 'SKU') !!}
                            {!! Form::text('sku',  null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('image', 'Image') !!}
                            {!! Form::file('image',  ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'] , null, ['class' => 'form-control', 'placeholder' => 'select status']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>



                    <div class="card-footer">
                        <a href="{{route('product.index')}}" class="btn btn-outline-secondary"><i class="fa fa arrow-right"></i> Back</a>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>

        </div>
    </div>
</div>
<script>
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select2').select2();
});

</script>
@endsection
