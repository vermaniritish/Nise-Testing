<?php foreach($listing->items() as $k => $row): ?>
<tr>
    <td>
        <!-- MAKE SURE THIS HAS ID CORRECT AND VALUES CORRENCT. THIS WILL EFFECT ON BULK CRUTIAL ACTIONS -->
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input listing_check" id="listing_check<?php echo $k; ?>"
                value="<?php echo $row->id; ?>">
            <label class="custom-control-label" for="listing_check<?php echo $k; ?>"></label>
        </div>
    </td>
    <td>
        <span class="badge badge-dot mr-4">
            <i class="bg-warning"></i>
            <span class="status"><?php echo $row->id; ?></span>
        </span>
    </td>

    <td>
        <?php echo $row->title; ?>
        @if ($row->image)
            <p>
                <a href="{{ $row->image }}" class="badge badge-dark text-decoration-none text-white px-2 small"
                    style="font-size: 0.65rem;" download>
                    Download
                </a>
            </p>
        @endif
    </td>

    <td>
        <div class="custom-control">
            <label class="custom-toggle">
                <?php $switchUrl = route('admin.actions.switchUpdate', ['relation' => 'testing_services', 'field' => 'status', 'id' => $row->id]); ?>
                <input type="checkbox" name="status" onchange="switch_action('<?php echo $switchUrl; ?>', this)"
                    value="1" <?php echo $row->status ? 'checked' : ''; ?>>
                <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
            </label>
        </div>
    </td>
    <td>
        <?php echo _dt($row->created); ?>
    </td>
    <td class="text-center">
        <div class="dropdown">
            <a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a class="dropdown-item" href="<?php echo route('admin.testingService.view', ['id' => $row->id]); ?>">
                    <i class="fas fa-eye text-yellow"></i>
                    <span class="status">View</span>
                </a>
                <div class="dropdown-divider"></div>
                <?php if(Permissions::hasPermission('testing_services', 'update')): ?>
                <a class="dropdown-item" href="<?php echo route('admin.testingService.edit', ['id' => $row->id]); ?>">
                    <i class="fas fa-pencil-alt text-info"></i>
                    <span class="status">Edit</span>
                </a>
                <?php endif; ?>

                <?php if(Permissions::hasPermission('testing_services', 'delete')): ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item _delete" href="javascript:;" data-link="<?php echo route('admin.testingService.delete', ['id' => $row->id]); ?>">
                    <i class="fas fa-times text-danger"></i>
                    <span class="status text-danger">Delete</span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </td>
</tr>
<?php endforeach; ?>
