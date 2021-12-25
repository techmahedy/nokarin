@extends('layouts.user')

@section('content')
   <h3 class="title-bar">Add New Driver</h3>
    @include('admin.message')

    <div class="booking-history-manager">
        <form action="{{ route('vehicle.driver.store') }}" method="post" enctype="multipart/form-data">
        @csrf 
        <div class="row">
            <div class="col-md-8">
                 <div class="form-group">
                    <label class="control-label">First Name *</label>
                    <input type="text" name="first_name" placeholder="Enter first name" class="form-control">
                 </div>
                 <div class="form-group">
                    <label class="control-label">Middle Name</label>
                    <input type="text" name="middle_name" placeholder="Enter middle name" class="form-control">
                 </div>
                 <div class="form-group">
                    <label class="control-label">Last Name *</label>
                    <input type="text" name="last_name" placeholder="Enter last name" class="form-control">
                 </div>
                 <div class="form-group">
                    <label class="control-label">Sex *</label> <br>
                    <input type="radio" name="sex" value="male"> Male
                    <input type="radio" name="sex" value="female"> Female
                 </div>
                 <div class="form-group">
                    <label class="control-label">License Number *</label>
                    <input type="text" name="license_number" placeholder="Enter license number" class="form-control">
                 </div>
                 <div class="form-group">
                    <label class="control-label">License Expiry Date *</label>
                    <input type="date" name="license_expiry_date" class="form-control">
                 </div>
                 <div class="form-group">
                    <label class="control-label">License Type *</label> <br>
                    <input type="radio" name="license_type" value="pro"> Pro
                    <input type="radio" name="license_type" value="non_pro"> Non Pro
                 </div>
                 <div class="form-group">
                    <label class="control-label">Restriction</label>
                    <select name="restriction" class="custom-select form-control">
                        <option value="0" selected disabled>Select Restriction</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                 </div>
                 <div class="form-group">
                    <label class="control-label">CP Contact Number *</label>
                    <input type="text" name="cp_contact_number" placeholder="CP Contact Number" class="form-control">
                 </div>
                 <div class="form-group">
                    <label class="control-label">Viber Number</label>
                    <input type="text" name="viber_number" placeholder="Viber Number" class="form-control">
                 </div>
                 <div class="form-group">
                    <label class="control-label">Facebook or Messenger Name *</label>
                    <input type="text" name="fb_or_messenger_name" placeholder="Facebook or Messenger Name" class="form-control">
                 </div>
                 <div class="form-group">
                    <label class="control-label">Contact Person in case of emergency *</label>
                    <input type="text" name="emg_cp_name" placeholder="Contact Person in case of emergency" class="form-control">
                 </div>
                 <div class="form-group">
                  <label class="control-label">Contact Person Number in case of emergency *</label>
                  <input type="text" name="emg_cp_number" placeholder="Contact Person Number in case of emergency" class="form-control">
               </div>
                 <div class="form-group">
                    <label class="control-label">Relation *</label>
                    <input type="text" name="relation" placeholder="Relation" class="form-control">
                 </div>
                 <div class="form-group">
                    <label class="control-label">Upload Authorization Letter if Driver and Vehicle Owner if different</label>
                    <input type="file" name="authorization_letter" class="form-control">
                 </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">ID Picture (1x1 or 2x2)</label>
                    <div class="form-group-image">
                        <div class="dungdt-upload-box dungdt-upload-box-normal " data-val="">
                           <input type="file" name="id_picture" v-model="value" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save Driver</button>
    </form>
    </div>
@endsection
