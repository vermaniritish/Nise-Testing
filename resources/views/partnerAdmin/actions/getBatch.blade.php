@if(!empty($batches) && $batches)
    <option value="">Select Batches </option>
	@foreach($batches as $b)
	   <option value="{{ $b['id'] }}">{{ $b['batch_title'] }}</option>
	@endforeach
@endif