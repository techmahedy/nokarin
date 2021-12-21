@extends('layouts.user')
@section('head')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
   <h3 class="title-bar">Vehicle Drivers</h3>
    @include('admin.message')
    <div class="booking-history-manager">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-4">
            <div class="form-inline">
             <div class="" style="left:0">
                 <form method="get" action="{{ route('vehicle.driver.get') }}" class="filter-form filter-form-right d-flex " role="search" data-select2-id="3">                     
                     <input type="text" name="q" value="" placeholder="Search by name" class="form-control">
                     <button class="btn-info btn btn-icon btn_search btn-sm" type="submit">Search</button>
                 </form>
             </div>
         </div>
            <a href="{{ route('vehicle.driver.create') }}" class="btn btn-primary btn-sm ">Add new driver</a>
        </div>

            <div class="filter-div d-flex justify-content-between ">
            {{-- <div class="col-left">
                <form method="get" action="{{ route('vehicle.driver.get') }}" class="filter-form filter-form-left d-flex justify-content-start">
                    <select name="filter" class="form-control">
                        <option value="" selected > Bulk Actions </option>
                        <option value="1"> Active </option>
                        <option value="0"> Inactive </option>
                    </select>
                    <button class="btn-info btn btn-icon dungdt-apply-form-btn btn-sm" type="submit">Apply</button>
                </form>
            </div> --}}
            </div>
        
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
                                       <a href="{{ route('vehicle.driver.show',$driver->id) }}" class="btn btn-info btn-sm">Details</a> |
                                       <a href="{{ route('vehicle.driver.edit',$driver->id) }}" class="btn btn-success btn-sm">Edit</a> |
                                       <a href="#" class="btn btn-danger btn-sm" id="delete_driver" data-id="{{$driver->id}}">Delete</a>
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
    </div>
@endsection
@section('footer')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var driverId = $(this).data('id'); 
            $.post("{{ route('vehicle.driver.status') }}", {
                status: status,
                driver_id: driverId,
                _token: '{{ csrf_token() }}'
            }, function (data) {
                Swal.fire('Driver status updated successfully!')
            });
       })

       $('body').on('click', '#delete_driver', function(e) {
            var id = $(this).data('id'); 
            if(!confirm("Do you want to really do this?")) {
               return false;
            }
            $.post("{{ route('vehicle.driver.delete') }}", {
                id: id,
                _token: '{{ csrf_token() }}'
            }, function (data) {
                window.location.reload(true);
            });
       })

    })
</script>
@endsection
