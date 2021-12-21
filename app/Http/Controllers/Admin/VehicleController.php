<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssignDriver;
use Illuminate\Http\Request;
use App\Models\VehicleDriver;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class VehicleController extends Controller
{   
    public function __construct()
    {
        $this->driver = VehicleDriver::class;
    }
    
    public function index(Request $request)
    {   
        $drivers = $this->driver::when($request->filter, function(Builder $query) use($request){
                            $query->where('status',$request->filter);
                        })
                        ->when($request->q, function(Builder $query) use($request){
                            $query->where('first_name', 'like', '%' . $request->get('q') . '%');
                        })
                        ->orderBy('id','desc')
                        ->paginate(10)->withQueryString();

        $data = [
            'fields'         => $drivers,
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Vehicle Driver'),
                    'class' => 'active'
                ],
            ],
        ];
      
        return view('Car::admin.car.driver.index', $data);
    }

    public function status(Request $request)
    {   
        $driver = $this->driver::find($request->driver_id);
        $driver->status = $request->status;
        $driver->save();

        return response()->json(['success']);
    }

    public function show($id)
    {   
        $data = [
            'fields'         => $this->driver::find($id),
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Vehicle Driver'),
                    'url'   => route('admin.driver.get')
                ],
                [
                    'name'  => __('Show'),
                    'class' => 'active'
                ],
            ],
        ];
 
        return view('Car::admin.car.driver.show', $data);
    }
    
    public function assignDriver(Request $request)
    {  
        $request->validate([
            'vehicle_driver_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required'
        ]);

        $result = DB::select(
                    'SELECT * FROM assign_drivers 
                    WHERE (date_from >= ? AND date_to <= ? AND vehicle_driver_id=?)
                    OR (date_from <= ? AND date_to >= ? AND vehicle_driver_id=?) 
                    OR (date_from <=? AND date_to >= ? AND vehicle_driver_id=?)',
                    [ 
                        $request->date_from,$request->date_to,$request->vehicle_driver_id,
                        $request->date_from,$request->date_from,$request->vehicle_driver_id,
                        $request->date_to,$request->date_to,$request->vehicle_driver_id
                    ]
                );
        
        if( $result == true) {
            $check_driver = AssignDriver::where('vehicle_driver_id',$request->vehicle_driver_id)
                                        ->first();
                if($check_driver){
                    $date_from  = \Carbon\Carbon::parse($check_driver->date_from)
                                        ->toFormattedDateString();
                    $date_to = \Carbon\Carbon::parse($check_driver->date_to)
                                                    ->toFormattedDateString();

                    return response()->json([
                        "error" => "This driver is scheduled from {$date_from} to {$date_to}"
                    ]);
                }
        }

        AssignDriver::create([
            'vehicle_driver_id' => $request->vehicle_driver_id,
            'date_from' => $request->date_from,
            'date_to' =>  $request->date_to
        ]);
        return response()->json([
            "message" => "This driver is assigned successfully!"
        ]);
 
    }



}
