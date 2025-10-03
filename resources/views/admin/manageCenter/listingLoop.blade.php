@foreach($listing->items() as $index => $row)
<tr>
    <td>
        <span class="badge badge-dot mr-4">
            <i class="bg-warning"></i>
            <span class="status">{{ $index + 1 }}</span>  {{-- Row Number --}}
        </span>
    </td>

    <td>
        {{ $row->title ?? 'N/A' }}/
        {{ $row->email ?? 'N/A' }}
    </td>

    <td>{{ $row->username ?? 'N/A' }}</td>
    <td>{{ $row->phone ?? 'N/A' }}</td>
    <td>{{ $row->states->name ?? 'N/A' }}</td>
    <td>{{ $row->district->name ?? 'N/A' }}</td> {{-- Duplicate? Adjust as needed --}}
    <td>{{ $row->city ?? 'N/A' }}</td>
    <td>
        <div class="custom-control">
            <label class="custom-toggle">
                <?php $switchUrl =  route('admin.actions.switchUpdate', ['relation' => 'centers', 'field' => 'status', 'id' => $row->id]); ?>
                <input type="checkbox" name="status" onchange="switch_action('<?php echo $switchUrl ?>', this)" value="1" <?php echo ($row->status ? 'checked' : '') ?>>
                <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
            </label>
        </div>
    </td>

    <td class="text-center">
        <div class="dropdown">
            <a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a class="dropdown-item" href="{{ route('admin.manageCenter.edit', $row->id) }}">
                    <i class="fas fa-pencil-alt text-info"></i>
                    <span class="status">Edit</span>
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item _delete" href="javascript:;" data-link="<?php echo route('admin.manageCenter.delete', ['id' => $row->id]); ?>">
                    <i class="fas fa-times text-danger"></i>
                    <span class="status text-danger">Delete</span>
                </a>
                <!-- <a class="dropdown-item _delete" href="javascript:;" data-link="{{ route('admin.manageCenter.delete', $row->id) }}">
                    <i class="fas fa-times text-danger"></i>
                    <span class="status text-danger">Delete</span>
                </a> -->
            </div>
        </div>
    </td>
</tr>
@endforeach
