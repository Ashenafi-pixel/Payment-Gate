<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Form</title>
</head>

<body>
    <h1>Admin Form</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route(\App\Helpers\IUserRole::ADMIN_ROLE . '.generateKeys') }}" method="post">
        @csrf
        <label for="user_ids">Select Users:</label>
        <select name="user_ids[]" multiple>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} (ID: {{ $user->id }})</option>
            @endforeach
        </select><br>
        <button type="submit">Generate Keys</button>
    </form>
</body>

</html>
