<?php

/**
 * Admin Dashboard Class
 *
 * @package    DashboardController


 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0
 */


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Settings;
use App\Libraries\General;
use App\Models\Admin\Grievances;
use App\Models\Admin\GrievancesTypes;
use Carbon\Carbon;

class DashboardController extends AppController
{
    function __construct()
    {
        parent::__construct();
    }


    public function index(Request $request)
    {

        return view('admin.dashboard.dashboard', []);
    }
}
