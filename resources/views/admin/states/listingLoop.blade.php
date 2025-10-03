@foreach($listing->items() as $k => $row)
<tr>
	<td>
		<!-- MAKE SURE THIS HAS ID CORRECT AND VALUES CORRENCT. THIS WILL EFFECT ON BULK CRUTIAL ACTIONS -->
		<div class="form-check">
        	<input type="checkbox" class="form-check-input listing_check" value="{{ $row->id }}" id="listing_check{{ $row->id }}">
        	<label class="form-check-label" for="listing_check{{ $row->id }}"></label>
      	</div>
	</td>
	<td>
		{{ $row->id }}
	</td>
	<td>
		{{ $row->name }}
	</td>
	<td>
        <div class="custom-control">
            <label class="custom-toggle">
                <?php $switchUrl = route('admin.actions.switchUpdate', ['relation' => 'states', 'field' => 'status', 'id' => $row->id]); ?>
                <input type="checkbox" name="status" onchange="switch_action('<?php echo $switchUrl; ?>', this)"
                    value="1" <?php echo $row->status ? 'checked' : ''; ?>>
                <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
            </label>
        </div>
    </td>
	<td>
		{{ _dt($row->created_at) }}
	</td>
	<td class="text-center">
        <div class="dropdown">
            <a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a class="dropdown-item" href="<?php echo route('admin.states.view', ['id' => $row->id]); ?>">
                    <i class="fas fa-eye text-yellow"></i>
                    <span class="status">View</span>
                </a>
                <div class="dropdown-divider"></div>
                <?php if(Permissions::hasPermission('states', 'update')): ?>
                <a class="dropdown-item" href="<?php echo route('admin.states.edit', ['id' => $row->id]); ?>">
                    <i class="fas fa-pencil-alt text-info"></i>
                    <span class="status">Edit</span>
                </a>
                <?php endif; ?>

                <?php if(Permissions::hasPermission('states', 'delete')): ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item _delete" href="javascript:;" data-link="<?php echo route('admin.states.delete', ['id' => $row->id]); ?>">
                    <i class="fas fa-times text-danger"></i>
                    <span class="status text-danger">Delete</span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </td>
</tr>
@endforeach