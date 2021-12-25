@extends('layouts.user')

@section('content')
   <h3 class="title-bar">{{ __('Driver Details') }}</h3>
    @include('admin.message')

    <div class="booking-history-manager">
        <div class="row">
            <div class="col-md-8">
                 <div class="form-group">
                    <label class="control-label">First Name</label>
                    <input type="text" name="first_name" value="{{ $fields->first_name }}" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                    <label class="control-label">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ $fields->middle_name }}" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                    <label class="control-label">Last Name</label>
                    <input type="text" name="last_name" value="{{ $fields->last_name }}" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                    <label class="control-label">Sex</label> <br>
                    <input type="radio" value="male" {{ $fields->sex == 'male' ? 'checked' : '' }}> Male
                    <input type="radio" value="female" {{ $fields->sex == 'female' ? 'checked' : '' }}> Female
                 </div>
                 <div class="form-group">
                    <label class="control-label">License Number</label>
                    <input type="text" name="license_number" value="{{ $fields->license_number }}" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                    <label class="control-label">License Expiry Date</label>
                    <input type="date" name="license_expiry_date" value="{{ $fields->license_expiry_date }}" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                    <label class="control-label">License Type *</label> <br>
                    <input type="radio" name="license_type" value="pro" {{ $fields->license_type == 'pro' ? 'checked' : '' }}> Pro
                    <input type="radio" name="license_type" value="non_pro" {{ $fields->license_type == 'non_pro' ? 'checked' : '' }}> Non Pro
                  </div>
                  <div class="form-group">
                     @php $restriction = json_decode($fields->restriction); @endphp
                     <label for="">Restriction</label> <br>
                     @for ($i = 1; $i < 7; $i++)
                        <input type="checkbox" name="restriction[]" value="{{ $i }}" {{ in_array($i,$restriction) ? 'checked' : '' }}> {{ $i }}
                     @endfor
                  </div>
                 <div class="form-group">
                    <label class="control-label">CP Contact Number</label>
                    <input type="text" name="cp_contact_number" value="{{ $fields->cp_contact_number }}" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                    <label class="control-label">Viber Number</label>
                    <input type="text" name="viber_number" value="{{ $fields->viber_number }}" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                    <label class="control-label">Facebook or Messenger Name</label>
                    <input type="text" name="fb_or_messenger_name" value="{{ $fields->fb_or_messenger_name }}" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                    <label class="control-label">Contact Person in case of emergency</label>
                    <input type="text" name="emg_cp_name" value="{{ $fields->emg_cp_name }}" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                  <label class="control-label">Contact Person Number in case of emergency *</label>
                  <input type="text" name="emg_cp_number"value="{{ $fields->emg_cp_number }}"  class="form-control">
               </div>
                 <div class="form-group">
                    <label class="control-label">Relation</label>
                    <input type="text" name="relation" value="{{ $fields->relation }}" class="form-control" readonly>
                 </div>
                 <div class="form-group">
                    <label class="control-label">Authorization Letter</label>
                    <a href="{{ $fields->authorization_letter }}">Authorization Letter</a>
                 </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">ID Picture (1x1 or 2x2)</label>
                    <div class="form-group-image">
                     <img src="{{$fields->id_picture }}" style="height: 100px;width:100px;"></img>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('vehicle.driver.get') }}" class="btn btn-success">Back</a>
    </div>
@endsection
