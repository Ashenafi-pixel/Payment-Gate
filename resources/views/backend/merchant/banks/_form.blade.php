<style>
    /* Remove border */
    input[type="text"].paragraph-like {
        border: none;
        background-color: transparent;
        padding: 0;
        font-size: inherit;
        font-family: inherit;
        outline: none;
    }
</style>
@if (Session::has('success'))
    <div id="successMessage" class="alert alert-success">
        {{ Session::get('success') }}
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
@endif
<div class="col-12 mt-3">
    <div class="d-box">
        <form action="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE . 'merchant.linkBank') }}" method="POST">
            @csrf

            <label for="bank_id">Select Your Bank:</label>
            <select name="bank_id" id="bank_id">
                @foreach ($banks as $bank)
                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                @endforeach
            </select><br>
            <label for="account_number">Your Account Number:</label>
            <input type="number" name="account_number">

            <button type="submit">Link Bank</button>
        </form>

    </div>
</div>
</div>
