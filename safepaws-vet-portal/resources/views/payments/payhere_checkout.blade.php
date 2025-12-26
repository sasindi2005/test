<form method="post" action="{{ env('PAYHERE_BASE_URL') }}" id="payhere-form">
    @foreach($data as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
</form>

<script>
    document.getElementById("payhere-form").submit();
</script>
