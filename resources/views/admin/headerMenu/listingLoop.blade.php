<?php foreach($listing->items() as $k => $row): ?>
<tr>
	<td>
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
		<?php echo $row->key ?>
	</td>
	<td>
		<?php echo $row->value ?>
	</td>
	<td class="text-center">
			<div class="dropdown">
				<a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
					<a class="dropdown-item" href="<?php echo route('admin.headerMenu.view', ['id' => $row->id]) ?>">
						<i class="fas fa-eye text-yellow"></i>
						<span class="status">View</span>
					</a>
					<div class="dropdown-divider"></div>
					<?php if(Permissions::hasPermission('header_menu', 'update')): ?>
				    <a class="dropdown-item" href="<?php echo route('admin.headerMenu.edit', ['id' => $row->id]) ?>">
						<i class="fas fa-pencil-alt text-info"></i>
						<span class="status">Edit</span>
					</a>
                    <div class="dropdown-divider"></div>
					<?php endif; ?>

					<?php if(Permissions::hasPermission('header_menu', 'delete')): ?>
					<a
						class="dropdown-item _delete"
						href="javascript:;"
						data-link="<?php echo route('admin.headerMenu.delete', ['id' => $row->id]) ?>"
					>
						<i class="fas fa-times text-danger"></i>
						<span class="status text-danger">Delete</span>
					</a>
					<?php endif; ?>
				</div>
			</div>
	</td>
</tr>
<?php endforeach; ?>
