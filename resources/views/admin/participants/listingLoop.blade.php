@foreach($listing->items() as $index => $row)
<tr>
    <!-- Serial Number -->
    <td>
        <span class="badge badge-dot mr-4">
            <i class="bg-warning"></i>
            <span class="status">{{ $loop->iteration }}</span>
        </span>
    </td>
    <td>
        {{ $row->full_name }} (<b>{{ $row->user_name }}</b>)<br>
        Email: {{ $row->email ?? 'N/A' }} <br>
        Contact No.: {{ $row->mobile ?? 'N/A' }}
    </td>

    <!-- Aadhaar -->
    <td>{{ $row->aadhar_number ?? 'N/A' }}</td>

    <!-- Center Name -->
    <td>{{ $row->center->title ?? 'N/A' }}</td>

    <!-- Academic Session -->
    <td>{{ $row->academic_session ?? 'N/A' }}</td>

    <!-- Batch Name -->
    <td>{{ $row->batch->batch_title ?? 'N/A' }}</td>

    <!-- State / District -->
    <td>{{ $row->states->name ?? '' }}/{{ $row->district->name ?? '' }}</td>

    <!-- Profile Image -->
    <td>
        <img src="{{ $row->candidate_image ? asset('uploads/participants/'.$row->candidate_image) : asset('assets/img/user.png') }}" style="width:50px;" />
    </td>
    <td>
        {{ $row->status }}
    </td>
    <!-- Status Toggle -->
   

    <!-- Action Buttons -->
    <td class="text-center">
        <div class="dropdown">
            <a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <!-- Edit -->
                <a class="dropdown-item" href="{{ route('admin.participant.edit', $row->id) }}">
                    <i class="fas fa-pencil-alt text-info"></i>
                    <span class="status">Edit</span>
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item _delete" href="javascript:;" data-link="<?php echo route('admin.participant.delete', ['id' => $row->id]); ?>">
                    <i class="fas fa-times text-danger"></i>
                    <span class="status text-danger">Delete</span>
                </a>
                <!-- Delete -->
                <!-- <a class="dropdown-item _delete" href="javascript:;" 
                   data-link="{{ route('admin.participant.delete', $row->id) }}">
                    <i class="fas fa-times text-danger"></i>
                    <span class="status text-danger">Delete</span>
                </a> -->
            </div>
        </div>
    </td>
</tr>
@endforeach
