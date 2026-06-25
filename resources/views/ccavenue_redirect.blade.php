<html>
<body>

<form id="ccavenueForm"
      method="post"
      action="{{ env('CCA_URL') }}">

    <input type="hidden"
           name="encRequest"
           value="{{ $encrypted_data }}">

    <input type="hidden"
           name="access_code"
           value="{{ env('CCA_ACCESS_CODE') }}">

</form>

<script>
document.getElementById('ccavenueForm').submit();
</script>

</body>
</html>