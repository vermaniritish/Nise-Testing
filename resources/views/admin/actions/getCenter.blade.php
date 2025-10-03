@if(!empty($centers) && $centers)
    <option value="">Select Center </option>
	@foreach($centers as $c)
	   <option value="{{ $c['id'] }}">{{ $c['title'] }}</option>
	@endforeach
@endif