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
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>{{ $row->phone ?? 'N/A' }}</td>
    <td>{{ $row->states->name ?? 'N/A' }}</td>
    <td>{{ $row->city ?? 'N/A' }}</td>
    <td>                    
        <a href="{{route('admin.batche.allocation')}}" class="label label-success">Allocate Batch</a>
    </td>

    <td>
        <label class="label label-success">Active</label>
        <label class="label label-success">Email Verified</label>                                                     
    </td>

    <td><a href="{{ route('admin.manageCenter.edit', $row->id) }}"><i class="fa fa-edit fa-2x"></i></a>
    <a href="center-academic-sessions.php"><i class="fa fa-calendar fa-2x"></i></a>
</tr>
@endforeach
