@foreach($listing->items() as $index => $row)
<tr>
    <td>
        <span class="badge badge-dot mr-4">
            <i class="bg-warning"></i>
            <span class="status">{{ $index + 1 }}</span>  {{-- Row Number --}}
        </span>
    </td>
    <td>{{ $row->institude->organisation_name ?? '' }}(<b>{{ $row->institude->institute_code ?? '' }}</b>)</td>
    <td>{{ $row->title ?? '' }}(<b>{{ $row->username ?? '' }}</b>)</td>
    <td>E-Mail :{{ $row->email ?? 'N/A' }}<br>Phone No.: {{ $row->phone ?? 'N/A' }}</td>
    <td>{{ $row->address ?? 'N/A' }}</td>
    <td>{{ $row->states->name ?? 'N/A' }}</td>
    <td>{{ $row->district->name ?? 'N/A' }}</td>
    <td>{{ $row->status == 1 ? 'Approved' : 'Re-Upload' }}</td>
    <td>{{ \Carbon\Carbon::parse($row->created)->format('Y-m-d H:i:s') }}</td>
</tr>
@endforeach
