@foreach($listing->items() as $index => $row)
<tr>
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
        {{ $row->center->title ?? 'N/A' }}<br>
        (<strong>{{ $row->center->username ?? 'N/A' }}</strong>)
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
                <a class="dropdown-item" href="{{ route('partnerAdmin.manageBatche.edit', $row->id) }}">
                    <i class="fas fa-pencil-alt text-info"></i>
                    <span class="status">Edit</span>
                </a>
            </div>
        </div>
    </td>
</tr>
@endforeach
