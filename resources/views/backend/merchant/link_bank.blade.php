<form action="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE . 'merchant.linkBank') }}" method="POST">
    @csrf

    <label for="bank_id">Select a Bank:</label>
    <select name="bank_id" id="bank_id">
        @foreach ($banks as $bank)
            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
        @endforeach
    </select>

    <button type="submit">Link Bank</button>
</form>
