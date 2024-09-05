@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-list"></i> Detail Category
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="my-input">Name</label>
                    <input id="my-input" class="form-control" type="text" name="name" placeholder="Name..."
                        value="{{ $category->name }}" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="my-input">Status</label>
                    <select name="status" id="" class="form-control" disabled readonly>
                        <option value=""></option>
                        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive
                        </option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary"><i
                        class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
