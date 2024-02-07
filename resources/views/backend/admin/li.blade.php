<form action="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE . '.checkLicense') }}" method="post">
    @csrf
    <input type="text" name="encodedData" placeholder="Enter encoded data" />
    <button type="submit">Submit</button>
</form>
