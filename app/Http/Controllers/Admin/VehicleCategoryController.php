<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\VehicleCategory;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class VehicleCategoryController extends Controller
{
    public function __construct()
    {
        $this->vehicleCategory = VehicleCategory::class;
    }
    
    public function index(Request $request)
    {   
        $vehicleCategory = $this->vehicleCategory::when($request->q, function(Builder $query) use($request){
                            $query->where('vehicle_category_name', 'like', '%' . $request->get('q') . '%');
                        })
                        ->orderBy('id','desc')
                        ->paginate(10)->withQueryString();

        $data = [
            'fields'         => $vehicleCategory,
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Vehicle Categories'),
                    'class' => 'active'
                ],
            ],
        ];
      
        return view('Car::admin.VehicleCategory.index', $data);
    }

    public function create()
    {   
        $data = [
            'fields'         => '',
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Create New Vehicle Category'),
                    'class' => 'active'
                ],
            ],
        ];

        return view('Car::admin.VehicleCategory.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_category_name' => 'required'
        ]);

        $this->vehicleCategory::create([
            'vehicle_category_name' => $request->input('vehicle_category_name'),
            'status'                => $request->input('status')
        ]);

        return redirect()->route('admin.vehicle.category.get')->with('success','Vehicle category created successfully!');

    }

    public function edit($id)
    {
        $data = $this->vehicleCategory::find($id);

        $data = [
            'fields'         => $data,
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Edit Vehicle Category'),
                    'class' => 'active'
                ],
            ],
        ];

        return view('Car::admin.VehicleCategory.update', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_category_name' => 'required'
        ]);

        $this->vehicleCategory::where('id',$id)->update([
            'vehicle_category_name' => $request->input('vehicle_category_name'),
            'status'                => $request->input('status')
        ]);

        return redirect()->route('admin.vehicle.car.bodytype.get')->with('success','Vehicle category updated successfully!');
    }
}
