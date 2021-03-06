<div class="panel">
    <div class="panel-title"><strong>{{__("Car Content")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label>{{__("Title")}}</label>
            <input type="text" value="{!! clean($translation->title) !!}" placeholder="{{__("Name of the car")}}" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Content")}}</label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
            </div>
        </div>
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("Youtube Video")}}</label>
                <input type="text" name="video" class="form-control" value="{{$row->video}}" placeholder="{{__("Youtube link video")}}">
            </div>
        @endif
        <div class="form-group-item">
            <label class="control-label">{{__('FAQs')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("Title")}}</div>
                    <div class="col-md-5">{{__('Content')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($translation->faqs))
                    @php if(!is_array($translation->faqs)) $translation->faqs = json_decode($translation->faqs); @endphp
                    @foreach($translation->faqs as $key=>$faq)
                        <div class="item" data-number="{{$key}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="faqs[{{$key}}][title]" class="form-control" value="{{$faq['title']}}" placeholder="{{__('Eg: When and where does the tour end?')}}">
                                </div>
                                <div class="col-md-6">
                                    <textarea name="faqs[{{$key}}][content]" class="form-control" placeholder="...">{{$faq['content']}}</textarea>
                                </div>
                                <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="{{__('Eg: Can I bring my pet?')}}">
                        </div>
                        <div class="col-md-6">
                            <textarea __name__="faqs[__number__][content]" class="form-control" placeholder=""></textarea>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("Banner Image")}}</label>
                <div class="form-group-image">
                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">{{__("Gallery")}}</label>
                {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
            </div>
        @endif
    </div>
</div>

@if(is_default_lang())
    <div class="panel">
        <div class="panel-title"><strong>{{__("Extra Info")}}</strong></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Passenger")}}</label>
                        <input type="number" value="{{$row->passenger}}" placeholder="{{__("Example: 3")}}" name="passenger" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Gear Shift")}}</label>
                        <input type="text" value="{{$row->gear}}" placeholder="{{__("Example: Auto")}}" name="gear" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Baggage")}}</label>
                        <input type="number" value="{{$row->baggage}}" placeholder="{{__("Example: 5")}}" name="baggage" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Door")}}</label>
                        <input type="number" value="{{$row->door}}" placeholder="{{__("Example: 4")}}" name="door" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(is_default_lang())
    <div class="panel">
        <div class="panel-title"><strong>{{__("Others Info")}}</strong></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Vehicle Category")}}</label>
                        <select name="vehicle_category_id" id="vehicle_category_id" class="form-control">
                           <option value="" selected disabled>Select Vehicle Category</option>
                           @forelse (\App\Models\VehicleCategory::where('status',1)->get() as $item)
                           <option value="{{ $item->id }}" {{  $item->id == $row->vehicle_category_id ? 'selected' : '' }} >{{ $item->vehicle_category_name }}</option>
                           @empty
                           @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Year Model")}}</label>
                        <input type="number" name="year_model" min="1900" max="2099" step="1"  class="form-control" value="{{ $row->year_model ? $row->year_model : '2016'}}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Chassis Number")}}</label>
                        <input type="text"class="form-control" name="chassis_number" placeholder="Chassis Number" value="{{$row->chassis_number}}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Engine Number")}}</label>
                        <input type="text" class="form-control" name="engine_number" placeholder="Engine Number" value="{{$row->engine_number}}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Body Type")}}</label>
                        <select name="car_body_type_id" id="car_body_type_id" class="form-control">
                           <option value="" selected disabled>Select Body Type</option>
                           @forelse (\App\Models\CarBodyType::where('status',1)->get() as $item)
                           <option value="{{ $item->id }}" {{  $item->id == $row->car_body_type_id ? 'selected' : '' }}>{{ $item->car_body_type_name }}</option>
                           @empty
                           @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{__("Plate #orConduction Sticker")}}</label>
                        <input type="text" class="form-control" name="plate_conduction_sticker" placeholder="Plate #orConduction Sticker" value="{{$row->plate_conduction_sticker}}"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>{{__("MV FILE NO")}}</label>
                        <input type="text"class="form-control" name="mv_file_no" placeholder="MV FILE NO" value="{{$row->mv_file_no}}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Garage Area")}}</label>
                        <input type="text" class="form-control" name="garage_area" placeholder="Garage Area" value="{{$row->garage_area}}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Copy of ORCR")}}</label>
                        <input type="file" class="form-control" name="copy_of_orcr"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Insurance Name")}}</label>
                        <input type="text" class="form-control" name="insurance_name"  placeholder="Insurance Name" value="{{$row->insurance_name}}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Copy of Insurance")}}</label>
                        <input type="file" class="form-control" name="copy_of_insurance"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{__("Deed Of Sale if applicable")}}</label>
                        <input type="file" class="form-control" name="deed_of_sale_if_applicable" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif