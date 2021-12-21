@extends('layouts.user')

@section('content')
   <h3 class="title-bar">{{ __('Edit Driver') }}</h3>
    @include('admin.message')

    <div class="booking-history-manager">
        <form action="{{ route('vehicle.driver.update',$fields->id) }}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('put')
            <div class="row">
                <div class="col-md-8">
                     <div class="form-group">
                        <label class="control-label">First Name</label>
                        <input type="text" name="first_name" value="{{ $fields->first_name }}" class="form-control">
                     </div>
                     <div class="form-group">
                        <label class="control-label">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ $fields->middle_name }}" class="form-control" >
                     </div>
                     <div class="form-group">
                        <label class="control-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ $fields->last_name }}" class="form-control" >
                     </div>
                     <div class="form-group">
                        <label class="control-label">Sex</label> <br>
                        <input type="radio" name="sex" value="male" {{ $fields->sex == 'male' ? 'checked' : '' }}> Male
                        <input type="radio" name="sex" value="female" {{ $fields->sex == 'female' ? 'checked' : '' }}> Female
                     </div>
                     <div class="form-group">
                        <label class="control-label">License Number</label>
                        <input type="text" name="license_number" value="{{ $fields->license_number }}" class="form-control" >
                     </div>
                     <div class="form-group">
                        <label class="control-label">License Expiry Date</label>
                        <input type="date" name="license_expiry_date" value="{{ $fields->license_expiry_date }}" class="form-control" >
                     </div>
                     <div class="form-group">
                        <label class="control-label">License Type *</label> <br>
                        <input type="radio" name="license_type" value="pro" {{ $fields->license_type == 'pro' ? 'checked' : '' }}> Pro
                        <input type="radio" name="license_type" value="non_pro" {{ $fields->license_type == 'non_pro' ? 'checked' : '' }}> Non Pro
                     </div>
                     <div class="form-group">
                        <label class="control-label">Restriction</label>
                        <select name="restriction" class="custom-select form-control">
                            <option value="0" selected disabled>Select Restriction</option>
                            <option value="1" {{ $fields->restriction == '1' ? 'selected' : '' }} >1</option>
                            <option value="2" {{ $fields->restriction == '2' ? 'selected' : '' }} >2</option>
                            <option value="3" {{ $fields->restriction == '3' ? 'selected' : '' }} >3</option>
                            <option value="4" {{ $fields->restriction == '4' ? 'selected' : '' }} >4</option>
                            <option value="5" {{ $fields->restriction == '5' ? 'selected' : '' }} >5</option>
                            <option value="6" {{ $fields->restriction == '6' ? 'selected' : '' }} >6</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="control-label">CP Contact Number</label>
                        <input type="text" name="cp_contact_number" value="{{ $fields->cp_contact_number }}" class="form-control" >
                     </div>
                     <div class="form-group">
                        <label class="control-label">Viber Number</label>
                        <input type="text" name="viber_number" value="{{ $fields->viber_number }}" class="form-control" >
                     </div>
                     <div class="form-group">
                        <label class="control-label">Facebook or Messenger Name</label>
                        <input type="text" name="fb_or_messenger_name" value="{{ $fields->fb_or_messenger_name }}" class="form-control" >
                     </div>
                     <div class="form-group">
                        <label class="control-label">Contact Person in case of emergency</label>
                        <input type="text" name="emg_cp_name" value="{{ $fields->emg_cp_name }}" class="form-control" >
                     </div>
                     <div class="form-group">
                        <label class="control-label">Relation</label>
                        <input type="text" name="relation" value="{{ $fields->relation }}" class="form-control" >
                     </div>
                     <div class="form-group">
                        <label class="control-label">Authorization Letter</label>
                        <input type="file" name="authorization_letter" id="">
                        <a href="{{ $fields->authorization_letter }}">Authorization Letter</a>
                     </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">ID Picture (1x1 or 2x2)</label>
                        <input type="file" name="id_picture" id="">
                        <div class="form-group-image">
                            <img src="{{@App::make('url')->to('/').'/'. $fields->id_picture }}" style="height: 100px;width:100px;"></img>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
