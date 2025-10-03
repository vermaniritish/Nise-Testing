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
use App\Libraries\General;
use Carbon\Carbon;

class DashboardController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }


    public function index(Request $request){
        $participantCount = Participant::count();
        $notices = Notices::where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(6);
        return view('partnerAdmin.dashboard.dashboard', [
            'notices' => $notices,
            'participantCount' => $participantCount
        ]);
    }
}
