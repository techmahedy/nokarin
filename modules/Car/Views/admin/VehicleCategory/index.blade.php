@extends('admin.layouts.app')
@section('script.head')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __("All Vehicle Categories") }}</h1>
            <div class="" style="left:0">
                <form method="get" action="{{ route('admin.vehicle.category.get') }}" class="filter-form filter-form-right d-flex " role="search" data-select2-id="3">                     
                    <input type="text" name="q" value="" placeholder="Search by name" class="form-control">
                    <button class="btn-info btn btn-icon btn_search btn-sm" type="submit">Search</button>
                </form>
            </div>
            <a href="{{ route('admin.vehicle.category.create') }}" class="btn-info btn btn-icon btn_search btn-sm ">Add Vehicle Category</a>
        </div>
        @include('admin.message')

        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fields as $driver)
                            <tr>
                               <td>{{ $loop->index + 1 }}</td>
                               <td>{{ $driver->vehicle_category_name }}</td>
                               <td>{{ $driver->status == 1 ? 'Active' : 'Inactive' }}</td>
                               <td>
                                   <a href="{{ route('admin.vehicle.category.edit',$driver->id) }}" class="btn btn-info btn-sm">Edit</a> 
                               </td>
                            </tr> 
                            @empty
                                <p>{{ __('No data founds!!') }}</p>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                    {{$fields->appends(request()->query())->links()}}
                </form>
            </div>
        </div>
        
    </div>
@endsection
@section('script.body')

@endsection

