<h1>Keys for User: {{ auth()->user()->name }}</h1>

<label for="privateKey">Private Key:</label>
<input type="text" id="privateKey" value="{{ $private_key }}" readonly>
<button onclick="copyToClipboard('privateKey')">Copy</button>

<label for="publicKey">Public Key:</label>
<input type="text" id="publicKey" value="{{ $public_key }}" readonly>
<button onclick="copyToClipboard('publicKey')">Copy</button>

<label for="apiToken">API Token:</label>
<input type="text" id="apiToken" value="{{ $api_token }}" readonly>
<button onclick="copyToClipboard('apiToken')">Copy</button>

<form method="post" action="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE . '.generate.new.keys') }}">
    @csrf
    <button type="submit">Generate New Keys</button>
</form>

<script>
    function copyToClipboard(id) {
        var input = document.getElementById(id);
        input.select();
        document.execCommand("copy");
        alert(id + " copied to clipboard!");
    }
</script>
