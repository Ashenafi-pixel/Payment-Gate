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
