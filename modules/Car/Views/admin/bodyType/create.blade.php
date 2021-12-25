@extends('admin.layouts.app')
@section('script.head')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __("Create New Car Body Type") }}</h1>
        </div>

        @include('admin.message')

        <div class="panel">
            <div class="panel-body">
                <form action="{{ route('admin.vehicle.car.bodytype.create') }}" class="bravo-form-item" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Car Body Type Name</label>
                        <input type="text" name="car_body_type_name" class="form-control" placeholder="Car Body Type Name">
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

