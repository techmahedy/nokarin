<!-- Modal -->
<form id="driverAssignForm">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <div>
                <h5 class="modal-title" id="exampleModalLabel">Assign Driver</h5>
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="success"></div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Select Driver<span style="color: red">*</span></label><br>
                    <select class="js-example-basic-single form-control" id="vehicle_driver_id" name="driver_id"  style="width:465px">
                        <option value="" selected disabled>Select Driver</option>
                        @forelse (\App\Models\VehicleDriver::where('status',1)->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                        @empty 
                        @endforelse
                    </select>
                    <span id="error"></span>
                </div>
                <div class="form-group">
                    <label for="">Date From<span style="color: red">*</span></label><br>
                    <input type="date" name="date_from" id="date_from" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Date To<span style="color: red">*</span></label><br>
                    <input type="date" name="date_to" id="date_to" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="driverAssignFormSubmit">Assign</button>
            </div>
          </div>
        </div>
    </div>
</form>