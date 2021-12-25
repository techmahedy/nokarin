<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarBodyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class CarBodyTypeController extends Controller
{
    public function __construct()
    {
        $this->carBodyType = CarBodyType::class;
    }
    
    public function index(Request $request)
    {   
        $carBodyType = $this->carBodyType::when($request->q, function(Builder $query) use($request){
                            $query->where('car_body_type_name', 'like', '%' . $request->get('q') . '%');
                        })
                        ->orderBy('id','desc')
                        ->paginate(10)->withQueryString();

        $data = [
            'fields'         => $carBodyType,
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Car Body Types'),
                    'class' => 'active'
                ],
            ],
        ];
      
        return view('Car::admin.bodyType.index', $data);
    }

    public function create()
    {   
        $data = [
            'fields'         => '',
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Create Car Body Type'),
                    'class' => 'active'
                ],
            ],
        ];

        return view('Car::admin.bodyType.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_body_type_name' => 'required'
        ]);

        $this->carBodyType::create([
            'car_body_type_name' => $request->input('car_body_type_name'),
            'status'             => $request->input('status')
        ]);

        return redirect()->route('admin.vehicle.car.bodytype.get')->with('success','Car body type created successfully!');

    }

    public function edit($id)
    {
        $data = $this->carBodyType::find($id);

        $data = [
            'fields'         => $data,
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Edit Car Body Type'),
                    'class' => 'active'
                ],
            ],
        ];

        return view('Car::admin.bodyType.update', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'car_body_type_name' => 'required'
        ]);

        $this->carBodyType::where('id',$id)->update([
            'car_body_type_name' => $request->input('car_body_type_name'),
            'status'             => $request->input('status')
        ]);

        return redirect()->route('admin.vehicle.car.bodytype.get')->with('success','Car body type created successfully!');
    }
}
