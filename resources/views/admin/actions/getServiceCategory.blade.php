@if(!empty($testServiceCategories) && $testServiceCategories)
    <option value="">Select Testing Services Catgeory</option>
    @foreach($testServiceCategories as $testingService)
        <option value="{{ $testingService['id'] }}">{{ $testingService->test_category_title }}</option>
    @endforeach
@endif