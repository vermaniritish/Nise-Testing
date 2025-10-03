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
use App\Models\Admin\Notices;
use App\Models\Admin\Admins;
use App\Models\Admin\Enrollments;
use App\Models\Admin\CustomPageData;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Pages;

class DashboardController extends AppController
{
    function __construct()
    {
        parent::__construct();
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
                // $url = '#';
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
                // $url = '#';
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

    function home(Request $reqeust)
    {
        // $page = CustomPageData::get();
        $notices = Notices::where('status', 1)
            ->orderBy('created', 'desc')->take(9)->get();
        $leftNotices = $notices->slice(0, 3);
        $rightNotices = $notices->slice(3, 3);
        return view('front/home/index',compact('leftNotices','rightNotices','notices'));
    }

    function testingService(Request $reqeust)
    {
        // $page = CustomPageData::get();
        $notices = Notices::where('status', 1)
            ->orderBy('created', 'desc')->get();
        return view('front/testService/index',compact('notices'));
    }

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

    function noticeDetails(Request $request, $id){

        $notice = Notices::where('status', 1)
            ->findOrFail($id);

        return view('front/noticeDetail', [
            'notice'  => $notice
        ]);
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
