<?php

namespace App\Http\Controllers;

use App\File\File;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VehicleDriver;
use Modules\FrontendController;
use App\Http\Requests\DriverRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\VehicleDriverCreated;

class VehicleDriverController extends FrontendController
{   
    use File;
    
    protected $url, $path, $driver;

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
      
        return view('User::frontend.driver.index', $data, [
            'filter' =>  $request->filter ? $request->filter : ''
        ]);
    }

    public function create()
    {   
        $data = [
            'fields'         => '',
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Vehicle Driver'),
                    'url'   => route('vehicle.driver.get')
                ],
                [
                    'name'  => __('Create'),
                    'class' => 'active'
                ],
            ],
        ];

        return view('User::frontend.driver.create', $data);
    }

    public function store(DriverRequest $request)
    {   
        if( $file = $request->file('id_picture') ) {
            $path = 'driver/id';
            $this->url = $this->image($file,$path,'','');
        }

        if( $file = $request->file('authorization_letter') ) {
            $path = 'uploads/authorize/letter';
            $this->path = $this->file($file,$path);
        }

        $driver = new VehicleDriver();
        $driver->first_name = $request->first_name;
        $driver->middle_name = $request->middle_name;
        $driver->last_name = $request->last_name;
        $driver->sex = $request->sex;
        $driver->license_number = $request->license_number;
        $driver->license_expiry_date = $request->license_expiry_date;
        $driver->license_type = $request->license_type;
        $driver->restriction = $request->restriction;
        $driver->cp_contact_number = $request->cp_contact_number;
        $driver->id_picture = $this->url;
        $driver->viber_number = $request->viber_number;
        $driver->fb_or_messenger_name = $request->fb_or_messenger_name;
        $driver->emg_cp_name = $request->emg_cp_name;
        $driver->relation = $request->relation;
        $driver->authorization_letter = $this->path ? '/storage/'.$this->path : '';
        $driver->save();
        
        $user = User::first();
        $user->notify(new VehicleDriverCreated($driver));
        
        return redirect()->route('vehicle.driver.get')->with('success','Driver created successfully!');
    }

    public function status(Request $request)
    {   
        $driver = $this->driver::find($request->driver_id);
        $driver->status = $request->status;
        $driver->save();

        return response()->json(['success']);
    }

    public function delete(Request $request)
    {
        $driver = $this->driver::find($request->id);
        if($driver->status == '1'){
            return redirect()->back()->with('success','You are not able to delete this!');
        }
        $driver->delete();
        return redirect()->back()->with('success','Driver deleted successfully!');
    }

    public function show($id)
    {   
        $data = [
            'fields'         => $this->driver::find($id),
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Vehicle Driver'),
                    'url'   => route('vehicle.driver.get')
                ],
                [
                    'name'  => __('Show'),
                    'class' => 'active'
                ],
            ],
        ];
 
        return view('User::frontend.driver.show', $data);
    }

    public function edit($id)
    {   
        $driver = $this->driver::find($id);

        $data = [
            'fields'         => $this->driver::find($id),
            'only_show_data' => 1,
            'breadcrumbs'    => [
                [
                    'name'  => __('Vehicle Driver'),
                    'url'   => route('vehicle.driver.get')
                ],
                [
                    'name'  => __('Edit'),
                    'class' => 'active'
                ],
            ],
        ];

        return view('User::frontend.driver.edit', $data);
    }

    public function update(Request $request, $id)
    {   
        if( $file = $request->file('id_picture') ) {
            $path = 'driver/id';
            $this->url = $this->image($file,$path,'','');
        }

        if( $file = $request->file('authorization_letter') ) {
            $path = 'uploads/authorize/letter';
            $this->path = $this->file($file,$path);
        }

        $driver = VehicleDriver::find($id);
        $driver->first_name = $request->first_name;
        $driver->middle_name = $request->middle_name;
        $driver->last_name = $request->last_name;
        $driver->sex = $request->sex;
        $driver->license_number = $request->license_number;
        $driver->license_expiry_date = $request->license_expiry_date;
        $driver->license_type = $request->license_type;
        $driver->restriction = $request->restriction;
        $driver->cp_contact_number = $request->cp_contact_number;
        $driver->id_picture = $this->url ? $this->url : $driver->id_picture;
        $driver->viber_number = $request->viber_number;
        $driver->fb_or_messenger_name = $request->fb_or_messenger_name;
        $driver->emg_cp_name = $request->emg_cp_name;
        $driver->relation = $request->relation;
        $driver->authorization_letter = $this->path ? '/storage/'.$this->path : $driver->authorization_letter;
        $driver->save();

        return redirect()->route('vehicle.driver.get')->with('success','Driver updated successfully!');
    }
}
