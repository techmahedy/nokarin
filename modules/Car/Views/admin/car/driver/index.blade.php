@extends('admin.layouts.app')
@section('script.head')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __("All Vehicle Drivers") }}</h1>
            <div class="" style="left:0">
                <form method="get" action="{{ route('admin.driver.get') }}" class="filter-form filter-form-right d-flex " role="search" data-select2-id="3">                     
                    <input type="text" name="q" value="" placeholder="Search by name" class="form-control">
                    <button class="btn-info btn btn-icon btn_search btn-sm" type="submit">Search</button>
                </form>
            </div>
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
                                <th>Driver Name</th>
                                <th> Sex</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fields as $driver)
                            <tr>
                               <td>{{ $loop->index + 1 }}</td>
                               <td>{{ $driver->first_name }}</td>
                               <td>{{ $driver->sex }}</td>
                               <td>
                                <input data-id="{{$driver->id}}" class="toggle-class" type="checkbox" data-onstyle="dark" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $driver->status == 1 ? 'checked' : '' }}>
                              </td>
                               <td>
                                   <a href="{{ route('admin.driver.show',$driver->id) }}" class="btn btn-info btn-sm">Details</a> 
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var driverId = $(this).data('id'); 
            $.post("{{ route('admin.driver.status') }}", {
                status: status,
                driver_id: driverId,
                _token: '{{ csrf_token() }}'
            }, function (data) {
                Swal.fire('Driver status updated successfully!')
            });
       })

    })
</script>
@endsection

