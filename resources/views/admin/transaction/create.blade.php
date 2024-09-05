@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-tittle">
                    <i class="fa fa-plus"></i> Input Excel
                </h3>
            </div>
                @csrf
                {{-- html  collective --}}
                {!! Form::open([ 'route' => 'transaction.import', 'files' => true, 'method' => 'POST']) !!}
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
                        <div class="form-group col-sm-12">
                            {!! Form::label('excel', 'Excel') !!}
                            {!! Form::file('excel',  ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-outline-secondary"><i class="fa fa arrow-right"></i> Back</a>
                        <button class="btn btn-primary float-right" type="submit">Import</button>
                    </div>
                    {!! Form::close() !!}
                </div>

        </div>
    </div>
</div>
{{-- <script>
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select2').select2();
});

</script> --}}
@endsection
