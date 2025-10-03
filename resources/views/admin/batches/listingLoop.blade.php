@foreach($listing->items() as $index => $row)
<tr>
    <td>
        <!-- MAKE SURE THIS HAS ID CORRECT AND VALUES CORRENCT. THIS WILL EFFECT ON BULK CRUTIAL ACTIONS -->
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input listing_check" id="listing_check<?php echo $row->id ?>" value="<?php echo $row->id ?>">
            <label class="custom-control-label" for="listing_check<?php echo $row->id ?>"></label>
        </div>
    </td>
    <td>
        <span class="badge badge-dot mr-4">
            <i class="bg-warning"></i>
            <span class="status">{{ $loop->iteration }}</span>
        </span>
    </td>

    <td>{{ $row->batch_id ?? 'N/A' }}</td>
    <td>{{ $row->batch_title ?? '' }}</td>
    <td>{{ $row->batch_strength ?? '' }}</td>

    <td>
        {{ $row->center_title ?? 'N/A' }}<br>
        (<strong>{{$row->center->username}}</strong>)
    </td>

    <td>{{ \Carbon\Carbon::parse($row->start_date)->format('d, M Y') }}</td>
    <td>{{ \Carbon\Carbon::parse($row->end_date)->format('d, M Y') }}</td>
    <td>{{ $row->academic_session ?? 'N/A' }}</td>
    <td>{{ $row->sanction_year ?? 'N/A' }}</td>
    <td>
        @if($row->status == 0)
            Yet to Start/New
        @elseif($row->status == 1)
            OnGoing
        @elseif($row->status == 2)
            Completed
        @endif
    </td>
    <td>
        @if(!empty($row->pdf_file))
            <a href="{{ asset('uploads/pdf/'.$row->pdf_file) }}" target="_blank">PDF File</a>
        @else
            <span>No File</span>
        @endif
    </td>

    <td class="text-center">
        <div class="dropdown">
            <a class="btn btn-sm btn-icon-only text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a class="dropdown-item" href="{{ route('admin.manageBatche.edit', $row->id) }}">
                    <i class="fas fa-pencil-alt text-info"></i>
                    <span class="status">Edit</span>
                </a>
                <a class="dropdown-item" href="{{route('admin.participant.add', $row->id)}}">
                    <i class="fas fa-plus text-info"></i>
                    <span class="status">Add Participant</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-times text-danger"></i>
                    <span class="status">Delete</span>
                </a>
            </div>
        </div>
    </td>

</tr>
@endforeach
