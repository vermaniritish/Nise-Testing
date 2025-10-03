@foreach($listing->items() as $index => $row)
<tr>
    <td>
        <span class="badge badge-dot mr-4">
            <i class="bg-warning"></i>
            <span class="status">{{ $index + 1 }}</span>  {{-- Row Number --}}
        </span>
    </td>
    <td>{{ $row->title ?? '' }}(<b>{{ $row->username ?? '' }}</b>)
        <br>Email: <b>{{ $row->email ?? '' }}</b>
    </td>
    <td>{{ $row->phone ?? 'N/A' }}</td>
    <td>{{ $row->states->name ?? 'N/A' }}</td>
    <td>{{ $row->city ?? 'N/A' }}</td>
    <td>{{ $row->status == 1 ? 'Approved' : 'Pending' }}</td>
    <td>                    
        Pending
    </td>

    <td>
        Pending                                                     
    </td>
</tr>
@endforeach
