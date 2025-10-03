
@if(!empty($district) && $district)
    <option value="">Select District </option>
	@foreach($district as $c)
	   <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
	@endforeach
@endif