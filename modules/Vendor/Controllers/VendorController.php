<?php

namespace Modules\Vendor\Controllers;

use App\User;
use App\File\File;
use Matrix\Exception;
use Illuminate\Http\Request;
use Modules\FrontendController;
use App\Helpers\ReCaptchaEngine;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Log;
use Modules\Booking\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Vendor\Models\VendorRequest;
use Illuminate\Support\Facades\Validator;
use Modules\User\Events\NewVendorRegistered;
use Modules\User\Events\SendMailUserRegistered;


class VendorController extends FrontendController
{   
    use File;

    protected $bookingClass;

    protected $path;

    public function __construct()
    {
        $this->bookingClass = Booking::class;
        parent::__construct();
    }
    public function register(Request $request)
    {   
        $rules = [
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'business_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password'   => [
                'required',
                'string'
            ],
            'term'       => ['required'],
        ];
        $messages = [
            'email.required'      => __('Email is required field'),
            'email.email'         => __('Email invalidate'),
            'password.required'   => __('Password is required field'),
            'first_name.required' => __('The first name is required field'),
            'last_name.required'  => __('The last name is required field'),
            'business_name.required'  => __('The business name is required field'),
            'term.required'       => __('The terms and conditions field is required'),
        ];
        if (ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")) {
            $messages['g-recaptcha-response.required'] = __('Please verify the captcha');
            $rules['g-recaptcha-response'] = ['required'];
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->with('error','Duplicate email address, please try again!');
        } else {
            if (ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")) {
                $codeCapcha = $request->input('g-recaptcha-response');
                if (!ReCaptchaEngine::verify($codeCapcha)) {
                    $errors = new MessageBag(['message_error' => __('Please verify the captcha')]);
                    return redirect()->back()->with('success','Please verify the captcha');
                }
            }
            $user = new \App\User();
            
            if( $file = $request->file('car_operator_identity_card') ) {
                $path = 'uploads/car/idcard';
                $this->path = $this->file($file,$path);
            }

            $user = $user->fill([
                'first_name'    => $request->input('first_name'),
                'last_name'     => $request->input('last_name'),
                'email'         => $request->input('email'),
                'password'      => Hash::make($request->input('password')),
                'business_name' => $request->input('business_name'),
                'phone'         => $request->input('phone'),
                'vendor_type'                => $request->input('vendor_type'),
                'car_operator_first_name'    => $request->input('car_operator_first_name'),
                'car_operator_last_name'     => $request->input('car_operator_last_name'),
                'car_operator_address'       => $request->input('car_operator_address'),
                'car_operator_contact_number'=> $request->input('car_operator_contact_number'),
                'is_logistics'               => $request->input('is_logistics') == 'yes' ? 1 : 0,
                'car_operator_identity_card' => $this->path ? '/storage/'.$this->path : ''
            ]);
            
            $user->status = 'publish';

            $user->save();
            if (empty($user)) {
                return $this->sendError(__("Can not register"));
            }

            //                check vendor auto approved
            $vendorAutoApproved = setting_item('vendor_auto_approved');
            $dataVendor['role_request'] = setting_item('vendor_role');
            if ($vendorAutoApproved) {
                if ($dataVendor['role_request']) {
                    $user->assignRole($dataVendor['role_request']);
                }
                $dataVendor['status'] = 'approved';
                $dataVendor['approved_time'] = now();
            } else {
                $dataVendor['status'] = 'pending';
                $user->assignRole('customer');
            }
            $vendorRequestData = $user->vendorRequest()->save(new VendorRequest($dataVendor));
            Auth::loginUsingId($user->id);
            try {
                event(new NewVendorRegistered($user, $vendorRequestData));
            } catch (Exception $exception) {
                Log::warning("NewVendorRegistered: " . $exception->getMessage());
            }
            if ($vendorAutoApproved) {
                return $this->sendSuccess([
                    'redirect' => url(app_get_locale(false, '/')),
                ]);
            } else {
                return redirect()->back()->with('success','Register success. Please wait for admin approval');
            }
        }
    }

    public function bookingReport(Request $request)
    {
        $data = [
            'bookings'    => $this->bookingClass::getBookingHistory($request->input('status'), false, Auth::id()),
            'statues'     => config('booking.statuses'),
            'breadcrumbs' => [
                [
                    'name'  => __('Booking Report'),
                    'class' => 'active'
                ],
            ],
            'page_title'  => __("Booking Report"),
        ];
        return view('Vendor::frontend.bookingReport.index', $data);
    }
}
