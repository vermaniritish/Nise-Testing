<?php

namespace App\Http\Controllers\PartnerAdmin;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\State;
use App\Models\Admin\District;
use App\Models\PartnerAdmin\Batche;

class ActionsController extends AppController
{
	function __construct()
	{
		parent::__construct();
	}

    function getDistrictsByStateId(Request $request, $state_id)
	{
		$select = [
			'district.id',
			'district.name',
			'district.status'
		];
		$where['district.status = ?'] = [1];
		$where['district.state_id = ?'] = [$state_id];

		$order = 'district.name asc';
		$district = District::getAll($select, $where, $order);

		$html = view(
			"partnerAdmin/actions/getDistrict",
			[
				'district' => $district
			]
		)->render();


		return Response()->json([
			'status' => 'success',
			'html' => $html
		]);
	}

	function getBatchByCenterId(Request $request, $center_id)
	{
		$select = [
			'batches.id',
			'batches.batch_title',
			'batches.status'
		];
		// $where['batches.status = ?'] = [1];
		$where['batches.center_id = ?'] = [$center_id];

		$order = 'batches.batch_title asc';
		$batches = Batche::getAll($select, $where, $order);

		$html = view(
			"partnerAdmin/actions/getBatch",
			[
				'batches' => $batches
			]
		)->render();


		return Response()->json([
			'status' => 'success',
			'html' => $html
		]);
	}
}
