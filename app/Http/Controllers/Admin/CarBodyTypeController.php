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
}
