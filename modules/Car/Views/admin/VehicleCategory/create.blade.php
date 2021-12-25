@extends('admin.layouts.app')
@section('script.head')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __("Create New Vehicle Category") }}</h1>
        </div>

        @include('admin.message')

        <div class="panel">
            <div class="panel-body">
                <form action="{{ route('admin.vehicle.category.create') }}" class="bravo-form-item" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Vehicle Category Name</label>
                        <input type="text" name="vehicle_category_name" class="form-control" placeholder="Vehicle Category Name">
                    </div>
                    <div class="form-group">
                        <input type="radio" name="status" class="form-control" value="1"> Active
                        <input type="radio" name="status" class="form-control" value="0"> Inactive
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

