<h2>Participants List</h2>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Code</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Aadhar</th>
            <th>Session</th>
            <th>Center</th>
            <th>Batch</th>
            <th>State/District</th>
        </tr>
    </thead>
    <tbody>
        @foreach($participants as $p)
        <tr>
            <td>{{ $p->full_name }}</td>
            <td>{{ $p->participant_code }}</td>
            <td>{{ $p->email ?? 'N/A' }}</td>
            <td>{{ $p->mobile ?? 'N/A' }}</td>
            <td>{{ $p->aadhar_number ?? 'N/A' }}</td>
            <td>{{ $p->academic_session ?? 'N/A' }}</td>
            <td>{{ $p->center->title ?? 'N/A' }}</td>
            <td>{{ $p->batch->batch_title ?? 'N/A' }}</td>
            <td>{{ $p->state_name }}/{{ $p->dist_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
