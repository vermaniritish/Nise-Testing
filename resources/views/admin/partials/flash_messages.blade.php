<div class="flash-message">
    @if (Session::has('success'))
        <p class="alert alert-success">


            {{-- @if (request()->segment(1) == 'hi')
                @lang('front.' . Session::get('success'))
            @else --}}
                {{ Session::get('success') }}
            {{-- @endif --}}


            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>
        {{ Session::forget('success') }}
    @endif
    @if (Session::has('error'))
        <p class="alert alert-danger">

            {{-- @if (request()->segment(1) == 'hi')
                @lang('front.' . Session::get('error'))
            @else --}}
                {{ Session::get('error') }}
            {{-- @endif --}}

            {{-- {{ Session::get('error') }} --}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>
        {{ Session::forget('error') }}
    @endif
</div>
