<form action="{{ route('ccavenue.pay') }}" method="POST">
    @csrf

    <button type="submit">
        Pay ₹1
    </button>
</form>