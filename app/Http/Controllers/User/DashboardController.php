<?php

/**
 * Admin Auth Class
 *
 * @package    AuthController


 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0
 */


namespace App\Http\Controllers\User;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Settings;
use App\Libraries\General;
use App\Models\UserAuth;
use App\Models\Admin\NewsEvent;
use App\Models\Admin\TestingService;
use App\Models\Admin\Notices;
use App\Models\Admin\Admins;
use App\Models\Admin\Enrollments;
use App\Models\Admin\CustomPageData;
use App\Models\Admin\TestServiceCategory;
use App\Models\Admin\ServiceCategoryWiseTest;
use App\Models\Admin\Order;
use App\Models\Admin\OrderTest;
use App\Models\Admin\OrderDetailOfDocument;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Pages;

class DashboardController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }

    public function userDashboard(Request $request){
        return view('front.user.userDashboard');
    }


    public function orderForms(Request $request){
        $testSerCategories = TestServiceCategory::select('testing_service_categories.*','testing_service.title as testing_service_title')
            ->leftJoin('testing_services as testing_service','testing_service.id','=','testing_service_categories.test_service_id')
            ->orderBy('test_service_id')
            ->orderBy('id')
            ->get()
            ->groupBy('test_service_id');
        return view('front.orderForms',['testSerCategories' => $testSerCategories]);
    }

    public function search(Request $request)
    {
        $term = $request->get('term');
        $events = NewsEvent::where('title', 'LIKE', "%{$term}%")
            ->limit(5)
            ->get(['id', 'title', 'file_type', 'pdf_file', 'url', 'date']);
        $notices = Notices::where('title', 'LIKE', "%{$term}%")
            ->limit(5)
            ->get(['id', 'title', 'file_type', 'pdf_file', 'url', 'date']);

        $results = [];
        foreach ($events as $event) {
            if ($event->file_type == 'pdf') {
                $url = $event->pdf_file ? asset($event->pdf_file) : null;
            } elseif ($event->file_type == 'url') {
                $url = $event->url;
            } else {
                $url = route('newsEventDetails', $event->id); 
            }

            $results[] = [
                'id'    => $event->id,
                'title' => $event->title,
                'date'  => $event->date ? \Carbon\Carbon::parse($event->date)->format('d M Y') : '',
                'type'  => 'event',
                'url'   => $url,
                'label' => $event->title,
                'value' => $event->title
            ];
        }
        foreach ($notices as $notice) {
            if ($notice->file_type == 'pdf') {
                $url = $notice->pdf_file ? asset($notice->pdf_file) : null;
            } elseif ($notice->file_type == 'url') {
                $url = $notice->url;
            } else {
                $url = route('noticeDetails', $notice->id); 
            }

            $results[] = [
                'id'    => $notice->id,
                'title' => $notice->title,
                'date'  => $notice->created_at ? $notice->created_at->format('d M Y') : '',
                'type'  => 'notice',
                'url'   => $url,
                'label' => $notice->title,
                'value' => $notice->title
            ];
        }

        return response()->json($results);
    }

    function screenReaderDetail(Request $request, $slug){
        
        $screenReaderAccess = Pages::where('pages.slug',$slug)->get();

        return view('front/screenReaderAccessPageDetail', [
            'scrRedrAcc'  => $screenReaderAccess
        ]);
    }

    function index(Request $request)
    {
        $userId = UserAuth::getLoginId();
        if($userId)
        {
            $user = UserAuth::find($userId);

            if ($request->isMethod('post')) {
                $data = $request->toArray();
                $validator = Validator::make($data, [
                    'address' => 'required|string|max:255',
                    'qualification' => 'nullable|string|max:100',
                    'country' => 'required',
                    'state' => 'nullable|string|max:100',
                    'pinzip' => 'required|digits_between:4,10',
                    'orgname' => 'required|string|max:100',
                    'orgaddress' => 'required|string|max:255',
                    'orgcontact' => 'nullable|string|max:100',
                    'orgemail' => 'required|email|max:255',
                    'orggst' => 'nullable|string|max:100',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                
                $user->address = $data['address'];
                $user->pin = $data['pinzip'];
                $user->qualification = $data['qualification'];
                $user->country = $data['country'];
                $user->state = $data['state'];
                $user->orgname = $data['orgname'];
                $user->orgaddress = $data['orgaddress'];
                $user->orgcontact = $data['orgcontact'];
                $user->orgemail = $data['orgemail'];
                $user->orggst = $data['orggst'];

                if ($user->save()) {
                    return redirect()->back()->with('success', 'Profile updated.');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Please try again.')->withInput();
                }
            }

            return view('front/home/dashboard', [
                'user' => $user,
                'enrollments' => Enrollments::where('user_id', $user->id)->orderBy('id', 'desc')->get()
            ]);
        }
        else
        {
            return redirect()->route('home.index');
        }
    }

    function home(Request $request)
    {
        // $page = CustomPageData::get();
        $notices = TestingService::where('status', 1)
            ->orderBy('created', 'desc')->take(9)->get();
        $leftNotices = $notices->slice(0, 3);
        $rightNotices = $notices->slice(3, 3);
        return view('front/home/index',compact('leftNotices','rightNotices','notices'));
    }

    function testingService(Request $request)
    {
        // $page = CustomPageData::get();
        $notices = TestingService::where('status', 1)
            ->orderBy('created', 'desc')->get();
        return view('front/testService/index',compact('notices'));
    }

    function testServiceDetails(Request $request, $slug)
    {
        $testingServices = TestingService::where('status', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        // pr($testingServices[0]->slug); die;
        // if(count($testingServices) > 0){
        //     return redirect()->route('testServiceDetails',['slug' => $testingServices[0]->slug]); 
        // }

        $serviceDetail = TestingService::where('testing_services.slug',$slug)->first();

        $selectedTypeIds = json_decode($serviceDetail->type_id, true);
        if (!is_array($selectedTypeIds)) {
            $selectedTypeIds = $selectedTypeIds ? [$selectedTypeIds] : [];
        }

        if (empty($selectedTypeIds)) {
            $testServCategories = collect(); 
        } else {
            $testServCategories = TestServiceCategory::whereIn('testing_service_categories.id', $selectedTypeIds)
                                    ->orderBy('testing_service_categories.id','desc')
                                    ->get();
        }

        return view('front/testService/serviceDetails',
            compact('testingServices','serviceDetail','testServCategories')
        );
    }

    // function testServiceDetails(Request $request, $slug)
    // {
    //     $testingServices = TestingService::where('status', 1)
    //                         ->orderBy('id', 'asc')
    //                         ->get();
    //     $serviceDetail = TestingService::where('testing_services.slug',$slug)->first();
    //     $selectedTypeIds = json_decode($serviceDetail->type_id, true);
    //     if(empty($selectedTypeIds)) {
    //         $testServCategories = collect(); // empty collection return
    //     } else {
    //         $testServCategories = TestServiceCategory::whereIn('testing_service_categories.id', $selectedTypeIds)
    //                                 ->orderBy('testing_service_categories.id','desc')
    //                                 ->get();
    //     }
    //     return view('front/testService/serviceDetails',compact('testingServices','serviceDetail','testServCategories'));
    // }

    private function generateOrderNumber()
    {
        return 'NETEST' . time() . rand(100, 999);
    }

    public function testServiceCategoryDetails(Request $request, $slug)
    {
        $testServiceCategoryDetail = TestServiceCategory::where('slug', $slug)->first();
        $serviceCategoryWiseTests = ServiceCategoryWiseTest::where('service_category_id', $testServiceCategoryDetail->id)->get();
        $userId = UserAuth::getLoginId();

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'total_number_of_sample' => 'required',
                'total_fee' => 'required',
                'grand_total_fee' => 'required',

                

                'order_test.sample_fee.*' => 'required',
                'order_test.number_of_sample.*' => 'required',
                'order_test.spv_per_sample.*' => 'required',
                'order_test.total_test_amount.*' => 'required',

                'order_detail.name_of_doc_ssi' => 'required|array',
                'order_detail.name_of_doc_ssi.*' => 'required',

                'order_detail.name_of_doc_billmat' => 'required|array',
                'order_detail.name_of_doc_billmat.*' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('upload_pv_module_docs')) {
                $file = $request->file('upload_pv_module_docs');

                $extension = $file->getClientOriginalExtension();
                $filename = time() . '-' . uniqid() . '.' . $extension;
                $file->move(public_path('uploads/upload_pv_module_docs'), $filename);
                $data['upload_pv_module_docs'] = '/uploads/upload_pv_module_docs/' . $filename;
            }

            if ($request->hasFile('internal_test_report')) {
                $file = $request->file('internal_test_report');

                $extension = $file->getClientOriginalExtension();
                $filename = time() . '-' . uniqid() . '.' . $extension;

                $file->move(public_path('uploads/internal_test_report'), $filename);

                $data['internal_test_report'] = '/uploads/internal_test_report/' . $filename;
            }

            // Save Order
            $order = Order::create([
                'user_id' => auth()->id(),                      
                'order_number' => $this->generateOrderNumber(),
                'total_number_of_sample' => $request->total_number_of_sample,
                'total_fee' => $request->total_fee,
                'gst_optional' => $request->gst_optional,
                'total_service_tax_fee' => $request->total_service_tax_fee,
                'tds_itr_value' => $request->tds_itr_value,
                'total_tds_itr' => $request->total_tds_itr,
                'tds_gst_value' => $request->tds_gst_value,
                'tds_scgst_value' => $request->tds_scgst_value,
                'total_tds_igst' => $request->total_tds_igst,
                'grand_total_fee' => $request->grand_total_fee,
                'upload_pv_module_docs' => isset($data['upload_pv_module_docs']) && $data['upload_pv_module_docs'] ? $data['upload_pv_module_docs'] : null,
                'internal_test_report'  => isset($data['internal_test_report']) && $data['internal_test_report'] ? $data['internal_test_report'] : null,
            ]);

            // ✔ SAFE: Check array exists before loop
            if (!empty($request->order_test['test_type_id'])) {
                foreach ($request->order_test['test_type_id'] as $index => $testTypeId) {
                    OrderTest::create([
                        'order_id' => $order->id,
                        'test_type_id' => $testTypeId,
                        'sample_fee' => $request->order_test['sample_fee'][$index] ?? 0,
                        'number_of_sample' => $request->order_test['number_of_sample'][$index] ?? 0,
                        'spv_per_sample' => $request->order_test['spv_per_sample'][$index] ?? 0,
                        'total_test_amount' => $request->order_test['total_test_amount'][$index] ?? 0,
                    ]);
                }
            }

            if (!empty($request->order_detail['name_of_doc_ssi'])) {

                foreach ($request->order_detail['name_of_doc_ssi'] as $index => $file) {

                    $ssiFilePath = null;
                    $billmatFilePath = null;

                    // ------ Upload SSI File ------
                    if ($request->hasFile("order_detail.name_of_doc_ssi.$index")) {

                        $file = $request->file("order_detail.name_of_doc_ssi.$index");

                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '-' . uniqid() . '.' . $extension;

                        // Upload directly to public/uploads/order_docs
                        $file->move(public_path('uploads/order_docs'), $filename);

                        // Save path to DB (public folder relative URL)
                        $ssiFilePath = '/uploads/order_docs/' . $filename;
                    }


                    // ------ Upload BillMat File ------
                    if ($request->hasFile("order_detail.name_of_doc_billmat.$index")) {

                        $file = $request->file("order_detail.name_of_doc_billmat.$index");

                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '-' . uniqid() . '.' . $extension;

                        $file->move(public_path('uploads/order_docs'), $filename);

                        $billmatFilePath = '/uploads/order_docs/' . $filename;
                    }


                    // Save in database
                    OrderDetailOfDocument::create([
                        'order_id' => $order->id,
                        'name_of_doc_ssi' => $ssiFilePath,
                        'name_of_doc_billmat' => $billmatFilePath,
                        'title' => $request->order_detail['title'][$index] ?? null,
                        'sub_title' => $request->order_detail['sub_title'][$index] ?? null,
                    ]);
                }
            }


            // if (!empty($request->order_detail['name_of_doc_ssi'])) {

            //     foreach ($request->order_detail['name_of_doc_ssi'] as $index => $ssiFileObj) {

            //         $ssiFilePath = null;
            //         $billmatFilePath = null;

            //         // ---------- SSI Document Upload ----------
            //         if ($request->hasFile("order_detail.name_of_doc_ssi.$index")) {
            //             $file = $request->file("order_detail.name_of_doc_ssi.$index");
            //             $extension = $file->getClientOriginalExtension();
            //             $filename = time() . '-' . uniqid() . '.' . $extension;
            //             $path = $file->storeAs('uploads/order_docs', $filename, 'public');
            //             $ssiFilePath = '/storage/' . $path;
            //         }

            //         // ---------- Bill Material Document Upload ----------
            //         if ($request->hasFile("order_detail.name_of_doc_billmat.$index")) {
            //             $file = $request->file("order_detail.name_of_doc_billmat.$index");
            //             $extension = $file->getClientOriginalExtension();
            //             $filename = time() . '-' . uniqid() . '.' . $extension;
            //             $path = $file->storeAs('uploads/order_docs', $filename, 'public');
            //             $billmatFilePath = '/storage/' . $path;
            //         }

            //         // ---------- Insert Into DB ----------
            //         OrderDetailOfDocument::create([
            //             'order_id'          => $order->id,
            //             'name_of_doc_ssi'   => $ssiFilePath,
            //             'name_of_doc_billmat' => $billmatFilePath,
            //             'title'             => $request->order_detail['title'][$index] ?? null,
            //             'sub_title'         => $request->order_detail['sub_title'][$index] ?? null,
            //         ]);
            //     }
            // }
            // if (!empty($request->order_detail['name_of_doc_ssi'])) {
            //     foreach ($request->order_detail['name_of_doc_ssi'] as $index => $file) {

            //         $ssiFile = $file->store('uploads/order_docs', 'public');
            //         $billmatFile = $request->order_detail['name_of_doc_billmat'][$index]->store('uploads/order_docs', 'public');

            //         OrderDetailOfDocument::create([
            //             'order_id' => $order->id,
            //             'name_of_doc_ssi' => $ssiFile,
            //             'name_of_doc_billmat' => $billmatFile,
            //             'title' => $request->order_detail['title'][$index],
            //             'sub_title' => $request->order_detail['sub_title'][$index],

            //         ]);
            //     }
            // }

            return redirect()->back()->with('success', 'Order Created Successfully!');
        }

        return view('front.testService.testServiceCategoryDetail', compact('testServiceCategoryDetail','serviceCategoryWiseTests'));
    }

    // public function testServiceCategoryDetails(Request $request, $slug)
    // {
    //     $testServiceCategoryDetail = TestServiceCategory::where('slug', $slug)->first();
    //     // pr($testServiceCategoryDetail); die;
    //     $serviceCategoryWiseTests = ServiceCategoryWiseTest::getAll();
    //     $userId = UserAuth::getLoginId();

    //     if ($request->isMethod('post')) {

    //         $validator = Validator::make($request->all(), [
    //             'total_number_of_sample' => 'required',
    //             'total_fee' => 'required',
    //             'grand_total_fee' => 'required',
    //             'order_test.test_type_id.*' => 'required',
    //             'order_test.sample_fee.*' => 'required',
    //             'order_test.number_of_sample.*' => 'required',
    //             'order_test.spv_per_sample.*' => 'required',
    //             'order_test.total_test_amount.*' => 'required',
    //             'order_detail.name_of_doc_ssi.*' => 'required',
    //             'order_detail.name_of_doc_billmat.*' => 'required',
    //         ]);

    //         if ($validator->fails()) {
    //             return back()->withErrors($validator)->withInput();
    //         }

    //         $order = Order::create([
    //             'user_id' => auth()->id(),
    //             'order_number' => $this->generateOrderNumber(),
    //             'total_number_of_sample' => $request->total_number_of_sample,
    //             'total_fee' => $request->total_fee,
    //             'gst_optional' => $request->gst_optional,
    //             'total_service_tax_fee' => $request->total_service_tax_fee,
    //             'tds_itr_value' => $request->tds_itr_value,
    //             'total_tds_itr' => $request->total_tds_itr,
    //             'tds_gst_value' => $request->tds_gst_value,
    //             'tds_scgst_value' => $request->tds_scgst_value,
    //             'total_tds_igst' => $request->total_tds_igst,
    //             'grand_total_fee' => $request->grand_total_fee,
    //         ]);

    //         foreach ($request->order_test['test_type_id'] as $index => $testTypeId) {
    //             OrderTest::create([
    //                 'order_id' => $order->id,
    //                 'test_type_id' => $testTypeId,
    //                 'sample_fee' => $request->order_test['sample_fee'][$index],
    //                 'number_of_sample' => $request->order_test['number_of_sample'][$index],
    //                 'spv_per_sample' => $request->order_test['spv_per_sample'][$index],
    //                 'total_test_amount' => $request->order_test['total_test_amount'][$index],
    //             ]);
    //         }

    //         foreach ($request->order_detail['name_of_doc_ssi'] as $index => $file) {

    //             $ssiFile = $file->store('uploads/order_docs', 'public');
    //             $billmatFile = $request->order_detail['name_of_doc_billmat'][$index]->store('uploads/order_docs', 'public');

    //             OrderDetailOfDocument::create([
    //                 'order_id' => $order->id,
    //                 'name_of_doc_ssi' => $ssiFile,
    //                 'name_of_doc_billmat' => $billmatFile,
    //             ]);
    //         }

    //         return redirect()->back()->with('success', 'Order Created Successfully!');
    //     }

    //     return view('front.testService.testServiceCategoryDetail', compact('testServiceCategoryDetail','serviceCategoryWiseTests'));
    // }

    function newsEvents(Request $request)
    {
        $newsEvents = NewsEvent::where('status', 1)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('front/newsEvents', [
            'newsEvents' => $newsEvents
        ]);
    }

    function newsEventDetails(Request $request, $id){
        // Get search keyword
        $search = trim($request->input('search'));

        // Single event details
        $newsEvent = NewsEvent::where('status', 1)
            ->findOrFail($id);

        // Recent Notices with optional search
        $newsEvents = NewsEvent::where('status', 1)
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('title_hi', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('front/newsEventDetails', [
            'newsEvent'  => $newsEvent,
            'newsEvents' => $newsEvents,
            'search'     => $search
        ]);
    }

    function notices(Request $request)
    {
        $notices = Notices::where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('front/notices', [
            'notices' => $notices
        ]);
    }

    function noticeDetails(Request $request, $slug){

        $notice = Notices::where('status', 1)
            ->where('slug', 'LIKE', $slug)
            ->limit(1)
            ->first();
        if($notice) {
            return view('front/noticeDetail', [
                'notice'  => $notice
            ]);
        }
        else {
            abort(404);
        }
    }

    function logout(Request $request)
    {
        UserAuth::logout();
        return redirect()->route('user.login');
    }

    function applicationPDF(Request $request, $id)
    {
        $userId = UserAuth::getLoginId();
        if($userId)
        {
            $enrollments = Enrollments::where('id', $id)->where('user_id', $userId)->orderBy('id', 'desc')->limit(1)->first();
            if($enrollments)
            {
                $html = view(
                    "front.applicationPDF", 
                    [
                        'enrollment' => $enrollments,
                        'logo' => Settings::get('logo')
                    ]
                )->render();
                $mpdf = new \Mpdf\Mpdf([
                    'tempDir' => public_path('/uploads/mpdf'),
                    'mode' => 'utf-8',
                    'orientation' => 'P',
                    'format' => [210, 297],
                    'setAutoTopMargin' => true,
                    'margin_left' => 10, 'margin_right' => 10, 'margin_top' => 10, 'margin_bottom' => 10
                ]);
                
                
                $mpdf->WriteHTML($html);
                $mpdf->Output('Orders '.$request->get('d').'.pdf','I');
            }
            else
            {
                abort('404');
            }
        }
        else
        {
            return redirect()->route('home.index');
        }
    }
}
