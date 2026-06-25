<?php foreach($listing->items() as $k => $row): ?>
    @php
        $serviceId = $row->service_category_wise_test->service->id ?? null;
        $filteredAdmins = $admins->filter(function ($admin) use ($serviceId) {
            $labTesting = json_decode($admin->lab_testing, true);
            if (!is_array($labTesting)) {
                return false;
            }
            return in_array($serviceId, $labTesting);
        });
    @endphp
    <tr>
        <td class="text-center"><div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input listing_check" id="listing_check<?php echo $row->id ?>" value="<?php echo $row->id ?>">
			<label class="custom-control-label" for="listing_check<?php echo $row->id ?>"></label>
		</div></td>
        <!-- visible/display columns (not inside the form) -->
        <td><?= $row->order_data->order_number ?? '' ?></td>
        <td><?= $row->service_category_wise_test->service->title ?? '' ?></td>
        <td><?= $row->service_category_wise_test->title ?? '' ?></td>
        <td><?= isset($row->order_data) ? _d($row->order_data->created) : '' ?></td>

        <!-- single td containing the form for this row -->
        <td colspan="7">
            <form action="{{ route('admin.testManagements') }}" method="POST" class="">
                @csrf
                <input type="hidden" name="test_id" value="<?= $row->id ?? '' ?>">
                <!-- hidden fields that will be submitted -->
                <!-- <input type="hidden" name="test_job_id" value="<?= $row->order_data->order_number ?? '' ?>">
                <input type="hidden" name="test_service" value="<?= $row->service_category_wise_test->service->id ?? '' ?>">
                <input type="hidden" name="test_type" value="<?= $row->service_category_wise_test->id ?? '' ?>"> -->
                <input type="hidden" name="order_date" value="<?= isset($row->order_data) ? _d($row->order_data->created) : '' ?>">

                <!-- visible inputs/selects (all inside the same form) -->
                <div class="row" style="gap:8px; align-items:center;">
                    <div class="col-auto">
                        <label>Assign Job</label>
                        <select name="assign_job" id="assign_job_<?= $k ?>" class="form-control">
                            <option value="">Select</option>
                             @foreach($filteredAdmins as $admin)
                                <option value="{{ $admin->id }}"
                                    {{ $row->assign_job == $admin->id ? 'selected' : '' }}>
                                    {{ $admin->first_name.' '.$admin->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-auto">
                        <label>Assigned Date</label>
                        <input type="date" name="assigned_date" value="{{$row->assigned_date}}" class="form-control" />
                    </div>

                    <div class="col-auto">
                        <label>Test Status</label>
                        <select name="test_status" id="test_status_<?= $k ?>" class="form-control">
                            <option value="">Select</option>
                            <option value="sample_accepted" <?= ($row->test_status == 'sample_accepted') ? 'selected' : '' ?>>Sample accepted</option>
                            <option value="sample_rejected" <?= ($row->test_status == 'sample_rejected') ? 'selected' : '' ?>>Sample rejected</option>
                            <option value="job_started" <?= ($row->test_status == 'job_started') ? 'selected' : '' ?>>Job Started</option>
                            <option value="more_info_required" <?= ($row->test_status == 'more_info_required') ? 'selected' : '' ?>>More info required</option>
                            <option value="test_completed" <?= ($row->test_status == 'test_completed') ? 'selected' : '' ?>>Test Completed</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <label>Test Start Date</label>
                        <input type="date" name="test_start_date" value="{{$row->test_start_date}}" class="form-control" />
                    </div>

                    <div class="col-auto">
                        <label>Test Job Completion Date</label>
                        <input type="date" name="test_job_completion_date" value="{{$row->test_job_completion_date}}" class="form-control" />
                    </div>

                    <div class="col-auto">
                        <label>Actual Completion Date</label>
                        <input type="date" name="actual_completion_date" value="{{$row->actual_completion_date}}" class="form-control" />
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>

                    <div class="col-auto">
                        <a href="{{route('admin.testManagements.view',['id' => $row->id])}}" class="btn btn-secondary btn-sm">Details</a>
                    </div>
                </div>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
