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
}
