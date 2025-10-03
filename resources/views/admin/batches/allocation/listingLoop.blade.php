@foreach($listing->items() as $row)
<tr>
    <!-- <td>
        <input type="checkbox" name="selected_rows[]" value="{{ $row->id }}">
    </td> -->
    <td>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="selected_rows[]" class="custom-control-input listing_check"
                   id="listing_check{{ $row->id }}" value="{{ $row->id }}">
            <label class="custom-control-label" for="listing_check{{ $row->id }}"></label>
        </div>
    </td>
    <td>{{ $loop->iteration }}</td>
    <td>
        {{ $row->user_organisation_name ?? 'N/A' }}/{{ $row->center_title ?? 'N/A' }}
        <input type="hidden" name="center_id[{{ $row->id }}]" value="{{ $row->center_id }}">
        <input type="hidden" name="institute_id[{{ $row->id }}]" value="{{ $row->institute_id }}">
    </td>
    <td>
        {{ $row->batch_title ?? '' }}
        <input type="hidden" name="batch_id[{{ $row->id }}]" value="{{ $row->id }}">
    </td>
    <td>
        {{ $row->batch_strength ?? '' }}
        <input type="hidden" name="batch_strength[{{ $row->id }}]" value="{{ $row->batch_strength }}">
    </td>
    <!-- <td>
        TAMIL NADU
        <input type="hidden" name="state[{{ $row->id }}]" value="TAMIL NADU">
    </td>
    <td>
        RAMANATHAPURAM
        <input type="hidden" name="city[{{ $row->id }}]" value="RAMANATHAPURAM">
    </td> -->
    <td>
        <input type="date" name="sanction_date[{{ $row->id }}]" class="form-control">
    </td>
    <td>
        <select name="status[{{ $row->id }}]" class="form-control">
            <option value="">Select Status</option>
            <option value="1">Approved</option>
            <option value="0">Not Approved</option>
        </select>
    </td>
    <td>
        <input type="file" name="allocated_doc[{{ $row->id }}]" class="form-control">
    </td>
</tr>
@endforeach
