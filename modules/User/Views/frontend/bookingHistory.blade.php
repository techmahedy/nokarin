@extends('layouts.user')
@section('head')

@endsection
@section('content')
    <h2 class="title-bar no-border-bottom">
        {{__("Booking History")}}
    </h2>
    @include('admin.message')
    <div class="booking-history-manager">
        <div class="tabbable">
            <ul class="nav nav-tabs ht-nav-tabs">
                <?php $status_type = Request::query('status'); ?>
                <li class="@if(empty($status_type)) active @endif">
                    <a href="{{route("user.booking_history")}}">{{__("All Booking")}}</a>
                </li>
                @if(!empty($statues))
                    @foreach($statues as $status)
                        <li class="@if(!empty($status_type) && $status_type == $status) active @endif">
                            <a href="{{route("user.booking_history",['status'=>$status])}}">{{booking_status_to_text($status)}}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            @if(!empty($bookings) and $bookings->total() > 0)
                <div class="tab-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-booking-history">
                            <thead>
                            <tr>
                                <th width="2%">{{__("Type")}}</th>
                                <th>{{__("Title")}}</th>
                                <th class="a-hidden">{{__("Order Date")}}</th>
                                <th class="a-hidden">{{__("Execution Time")}}</th>
                                <th>{{__("Total")}}</th>
                                <th>{{__("Paid")}}</th>
                                <th>{{__("Remain")}}</th>
                                <th class="a-hidden">{{__("Status")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                @include(ucfirst($booking->object_model).'::frontend.bookingHistory.loop')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="bravo-pagination">
                        {{$bookings->appends(request()->query())->links()}}
                    </div>
                </div>
            @else
                {{__("No Booking History")}}
            @endif
        </div>
    </div>
@endsection
@section('footer')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {

        $('.js-example-basic-single').select2();
    
        $('#driverAssignForm').validate({ 
            rules: {
                driver_id: {
                    required: true
                },
                date_from: {
                    required: true
                },
                date_to: {
                    required: true
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
        
        $('body').on('click', '#driverAssignFormSubmit', function(e) {
            e.preventDefault();
            let driver_id = $('#vehicle_driver_id').children("option:selected").val();
            let date_from = $('#date_from').val();
            let date_to   = $('#date_to').val();
            $.post("{{ route('admin.assign.driver') }}", {
                vehicle_driver_id: driver_id,
                date_from:date_from,
                date_to:date_to,
                _token: '{{ csrf_token() }}'
            }, function (data) {
                if(data?.error) {
                    $('#error').html(data?.error).css('color','red');
                }else{
                    $('#success').html(data?.message).css('color','green');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            });
        })

        });

</script>
@endsection
