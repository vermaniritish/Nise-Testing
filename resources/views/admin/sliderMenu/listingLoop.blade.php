<?php foreach($listing->items() as $k => $row): ?>
<tr>
	<td class="text-center">
		<!-- MAKE SURE THIS HAS ID CORRECT AND VALUES CORRENCT. THIS WILL EFFECT ON BULK CRUTIAL ACTIONS -->
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input listing_check" id="listing_check<?php echo $k ?>" value="<?php echo $row->id ?>">
			<label class="custom-control-label" for="listing_check<?php echo $k ?>"></label>
		</div>
	</td>
	<td>
		<span class="badge badge-dot mr-4">
			<i class="bg-warning"></i>
			<span class="status"><?php echo $row->id ?></span>
		</span>
	</td>
	<td>
		<?php echo $row->heading ?>
	</td>
    <td>
		@if(Permissions::hasPermission('slider_menu', 'update'))
		<div class="custom-control">
			<label class="custom-toggle">
				<?php $switchUrl =  route('admin.actions.switchUpdate', ['relation' => 'slider_menu', 'field' => 'status', 'id' => $row->id]); ?>
				<input type="checkbox" name="status" onchange="switch_action('<?php echo $switchUrl ?>', this)" value="1" <?php echo ($row->status ? 'checked' : '') ?>>
				<span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
			</label>
		</div>
		@else
		<?php echo ($row->status ? 'Active' : 'Inactive') ?>
		@endif
	</td>
	<td>
		<?php echo _dt($row->created) ?>
	</td>
	<?php if(Permissions::hasPermission('slider_menu', 'update') || Permissions::hasPermission('slider_menu', 'delete')): ?>
	<td class="text-center">
			<div class="dropdown">
				<a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
					<?php if(Permissions::hasPermission('slider_menu', 'update')): ?>
					<a class="dropdown-item" href="<?php echo route('admin.sliderMenu.edit', ['id' => $row->id]) ?>">
						<i class="fas fa-pencil-alt text-info"></i>
						<span class="status">Edit</span>
					</a>
					<?php endif; ?>

					<?php if(Permissions::hasPermission('slider_menu', 'delete')): ?>
					<div class="dropdown-divider"></div>
					<a
						class="dropdown-item _delete"
						href="javascript:;"
						data-link="<?php echo route('admin.sliderMenu.delete', ['id' => $row->id]) ?>"
					>
						<i class="fas fa-times text-danger"></i>
						<span class="status text-danger">Delete</span>
					</a>
					<?php endif; ?>
				</div>
			</div>
	</td>
	<?php endif; ?>
</tr>
<?php endforeach; ?>
