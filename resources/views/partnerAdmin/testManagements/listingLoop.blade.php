
<?php foreach($listing->items() as $k => $row): ?>
    <tr>
        <!-- visible/display columns (not inside the form) -->
        <td><?= $row->order_data->order_number ?? '' ?></td>
        <td><?= $row->service_category_wise_test->service->title ?? '' ?></td>
        <td><?= $row->service_category_wise_test->title ?? '' ?></td>
        <td><?= isset($row->order_data) ? _d($row->order_data->created) : '' ?></td>

        <!-- single td containing the form for this row -->
        <td colspan="7">
            <form action="{{ route('partnerAdmin.testManagements') }}" method="POST" class="form-inline">
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
                        <select name="assign_job" id="assign_job_<?= $k ?>" class="form-control">
                            <option value="">Select</option>
                            @foreach($admins as $admin)
                            <option value="{{$admin->id}}">{{$admin->first_name.' '.$admin->last_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-auto">
                        <input type="date" name="assigned_date" class="form-control" />
                    </div>

                    <div class="col-auto">
                        <select name="test_status" id="test_status_<?= $k ?>" class="form-control">
                            <option value="">Select</option>
                            <option value="sample_accepted">Sample accepted</option>
                            <option value="sample_rejected">Sample rejected</option>
                            <option value="job_started">Job Started</option>
                            <option value="more_info_required">More info required</option>
                            <option value="test_completed">Test Completed</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <input type="date" name="test_start_date" class="form-control" />
                    </div>

                    <div class="col-auto">
                        <input type="date" name="test_job_completion_date" class="form-control" />
                    </div>

                    <div class="col-auto">
                        <input type="date" name="actual_completion_date" class="form-control" />
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>

                    <div class="col-auto">
                        <a href="{{route('partnerAdmin.testManagements.view',['id' => $row->id])}}" class="btn btn-secondary btn-sm">Details</a>
                    </div>
                </div>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
