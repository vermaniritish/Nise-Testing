<?php

/**
 * Admin Dashboard Class
 *
 * @package    DashboardController


 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0
 */


namespace App\Http\Controllers\PartnerAdmin;

use Illuminate\Http\Request;
use App\Models\Admin\Settings;
use App\Models\Admin\Notices;
use App\Models\PartnerAdmin\Participant;
use Illuminate\Support\Facades\Auth;
use App\Libraries\General;
use App\Models\Admin\State;
use App\Models\Admin\Order;
use App\Models\Admin\OrderTest;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }


    public function index(Request $request){
        $userDetails = Auth::user();
        $states = State::all();
        $orderIds = Order::where('user_id', $userDetails->id)->pluck('id')->toArray();
        $orders = OrderTest::select('order_tests.*',
            'order.order_number as order_number',
            'order.grand_total_fee as grand_total_fee',
            'service_category_wise_tests.title as category_title',
            'testing_services.title as service_title'
        )
        ->whereIn('order_tests.order_id', $orderIds)
        ->leftJoin('orders as order','order.id','=','order_tests.order_id')
        ->leftJoin('service_category_wise_tests', 'service_category_wise_tests.id', '=', 'order_tests.test_type_id')
        ->leftJoin('testing_services', 'testing_services.id', '=', 'service_category_wise_tests.service_id')
        ->groupBy('order_tests.order_id')
        ->get();
        // pr($orders); die;
        return view('partnerAdmin.dashboard.dashboard', [
            'user' => $userDetails,
            'states' => $states,
            'orders' => $orders
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // $type = $user->registration_type; // user ka type DB se hi lenge
        $type = $request->reg_type;
        if ($type === 'Company') {

            // VALIDATION
            $request->validate([
                'company_name'       => 'required|string|max:255',
                'address_1'          => 'required|string|max:255',
                'address_2'          => 'nullable|string|max:255',
                'state_id'           => 'required|exists:states,id',
                'city'               => 'required|string|max:255',
                'pincode'            => 'required|digits:6',
                'pan'                => 'required|string|max:10',
                'tin'                => 'required|string|max:50',
                'gst'                => 'required|string|max:50',
                'person_name'        => 'required|string|max:255',
                'email'              => 'required|email|max:255|unique:users,email,' . $id,
            ]);


            // PAN File Update
            if ($request->hasFile('pan_file')) {
                if ($user->pan_file && \Storage::disk('public')->exists($user->pan_file)) {
                    \Storage::disk('public')->delete($user->pan_file);
                }
                $user->pan_file = $request->file('pan_file')->store('uploads/pan', 'public');
            }

            // Company File Update
            if ($request->hasFile('company_file')) {
                if ($user->company_file && \Storage::disk('public')->exists($user->company_file)) {
                    \Storage::disk('public')->delete($user->company_file);
                }
                $user->company_file = $request->file('company_file')->store('uploads/company', 'public');
            }

            // UPDATE FIELDS
            $user->company_name       = $request->company_name;
            $user->address_1          = $request->address_1;
            $user->address_2          = $request->address_2;
            $user->state_id           = $request->state_id;
            $user->city               = $request->city;
            $user->pincode            = $request->pincode;
            $user->pan                = strtoupper($request->pan);
            $user->tin                = $request->tin;
            $user->gst                = $request->gst;
            $user->registration_number= $request->registration_number;
            $user->person_name        = $request->person_name;
            $user->mobile             = $request->mobile;
            $user->email              = $request->email;
            $user->save();

        } elseif ($type === 'Individual') {

            // VALIDATION
            $request->validate([
                'ind_contact_person_name' => 'required|string|max:255',
                'ind_address_1'           => 'required|string|max:255',
                'ind_address_2'           => 'nullable|string|max:255',
                'ind_state_id'            => 'required|exists:states,id',
                'ind_city_or_district'    => 'required|string|max:255',
                'ind_pin_code'            => 'required|digits:6',
                'mobile'       => 'required|string|max:15',
                'email'               => 'required|email|max:255|unique:users,email,' . $id,
            ]);

            // UPDATE
            $user->ind_contact_person_name = $request->ind_contact_person_name;
            $user->ind_address_1           = $request->ind_address_1;
            $user->ind_address_2           = $request->ind_address_2;
            $user->ind_state_id            = $request->ind_state_id;
            $user->ind_city_or_district    = $request->ind_city_or_district;
            $user->ind_pin_code            = $request->ind_pin_code;
            $user->ind_mobile_number       = $request->mobile;
            $user->ind_email               = $request->email;
            $user->mobile                  = $request->mobile;
            $user->email                   = $request->email;
            // $user->ind_mobile_number       = $request->ind_mobile_number;
            // $user->ind_email               = $request->ind_email;

            $user->save();
        }

        return back()->with('success', 'Profile updated successfully!');
    }

}
