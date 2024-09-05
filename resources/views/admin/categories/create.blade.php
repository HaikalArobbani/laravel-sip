@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-tittle">
                    <i class="fa fa-plus"></i> Add category
                </h3>
            </div>
            <form action="{{ route('categories.store')}}" method="POST">
                @csrf
                <div class="card-body">

                    @if(!empty($errors->all()))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="nama....">
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control">
                        <option value="">--Pilih option</option>
                        <option value="active">Active</option>
                        <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('categories.index')}}" class="btn btn-outline-secondary"><i class="fa fa arrow-right"></i> Back</a>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
@endsection
