@extends('admin.layouts.app')
@section('script.head')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __("Edit Vehicle Category") }}</h1>
        </div>

        @include('admin.message')

        <div class="panel">
            <div class="panel-body">
                <form action="{{ route('admin.vehicle.category.edit',$fields->id) }}" class="bravo-form-item" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="">Vehicle Category Name</label>
                        <input type="text" name="vehicle_category_name" class="form-control" value="{{ $fields->vehicle_category_name }}">
                    </div>
                    <div class="form-group">
                        <input type="radio" name="status" class="form-control" value="1" {{ $fields->status == 1 ? 'checked' : '' }}> Active
                        <input type="radio" name="status" class="form-control" value="0" {{ $fields->status == 0 ? 'checked' : '' }}> Inactive
                    </div>
                    <div class="form-group">
                       <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
@endsection
@section('script.body')

@endsection

