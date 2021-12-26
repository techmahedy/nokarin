@php
    $terms_ids = $row->terms->pluck('term_id');
    $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
@endphp


@if ($row->vehicle_category)
<hr>
<h6>Car Category : {{ $row->vehicle_category->vehicle_category_name ?? 'Nai' }}</h6>
@endif

@if ($row->body_type)
<h6>Body Type : {{ $row->body_type->vehicle_category_name ?? 'Nai' }}</h6>
@endif

@if ($row->year_model)
<hr>
<h6>Year Model : {{ $row->year_model }}</h6>
@endif

@if ($row->chassis_number)
<hr>
<h6>Chassis Number : {{ $row->chassis_number }}</h6>
@endif

@if ($row->engine_number)
<hr>
<h6>Engine Number : {{ $row->engine_number }}</h6>
@endif

@if ($row->plate_conduction_sticker)
<hr>
<h6>Sticker : {{ $row->plate_conduction_sticker }}</h6>
@endif

@if ($row->mv_file_no)
<hr>
<h6>Mv File No : {{ $row->mv_file_no }}</h6>
@endif

@if ($row->garage_area)
<hr>
<h6>Garage Area : {{ $row->garage_area }}</h6>
@endif

@if ($row->copy_of_orcr)
<hr>
<h6>Copy : {{ $row->copy_of_orcr }}</h6>
@endif

@if ($row->insurance_name)
<hr>
<h6>Insurance Name : {{ $row->insurance_name }}</h6>
@endif

@if ($row->copy_of_insurance)
<hr>
<h6>Copy of Insurance : {{ $row->copy_of_insurance }}</h6>
@endif

@if ($row->deed_of_sale_if_applicable)
<hr>
<h6>Sale Applicable : {{ $row->deed_of_sale_if_applicable }}</h6>
@endif


<hr>
@if(!empty($terms_ids) and !empty($attributes))
    @foreach($attributes as $attribute )
        @php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) @endphp
        @if(empty($attribute['parent']['hide_in_single']))
            <div class="g-attributes {{$attribute['parent']->slug}} attr-{{$attribute['parent']->id}}">
                <h3>{{ $translate_attribute->name }}</h3>
                @php $terms = $attribute['child'] @endphp
                <div class="list-attributes {{$attribute['parent']['display_type'] ?? ""}}">
                    @foreach($terms as $term )
                        @php $translate_term = $term->translateOrOrigin(app()->getLocale()) @endphp
                        <div class="item {{$term->slug}} term-{{$term->id}}">
                            @if(!empty($term->image_id))
                                @php $image_url = get_file_url($term->image_id, 'full'); @endphp
                                <img src="{{$image_url}}" class="img-responsive" alt="{{$translate_term->name}}">
                            @else
                                <i class="{{ $term->icon ?? "icofont-check-circled icon-default" }}"></i>
                            @endif
                            {{$translate_term->name}}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    @endforeach
@endif
