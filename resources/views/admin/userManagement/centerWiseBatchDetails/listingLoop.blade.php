@foreach($listing->items() as $index => $row)
<tr>
    <!-- Serial Number -->
    <td>
        <span class="badge badge-dot mr-4">
            <i class="bg-warning"></i>
            <span class="status">{{ $loop->iteration }}</span>
        </span>
    </td>

    <!-- Participant Info -->
    <td>
        {{ $row->full_name }} (<b>SM-STU-54729</b>)
    </td>

    <!-- Aadhaar -->
    <td>{{ $row->father_name ?? '' }}</td>

    <!-- Center Name -->
    <td>{{ $row->center->title ?? '' }}(TP/RAW/RJ/2005515/CEN/RJ/70)</td>

    <td>E-Mail : {{ $row->email ?? '' }}<br>Phone No.: {{ $row->mobile ?? '' }}</td>

    <!-- Batch Name -->
    <td>{{ $row->address ?? '' }}</td>

    <td>{{ $row->aadhar_number ?? '' }}</td>

    <td>{{ $row->caste_category ?? '' }}</td>

    <!-- State / District -->
    <td>{{ $row->states->name ?? '' }}</td>

    <td>{{ $row->district->name ?? '' }}</td>

    <td>{{ $row->gender ?? '' }}</td>

    <!-- Profile Image -->
    <td>
        <img src="{{ $row->candidate_image ? asset('uploads/participants/'.$row->candidate_image) : asset('assets/img/user.png') }}" style="width:50px;" />
    </td>
    <td>
        {{ $row->status }}
    </td>

    <td>0</td>

    <td>{{ $row->company_name ?? '' }}</td>
</tr>
@endforeach
