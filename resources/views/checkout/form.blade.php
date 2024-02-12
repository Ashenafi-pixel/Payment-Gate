<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sender - Form</title>
</head>

<body>
    <form action="{{ route('form.handle') }}" method="post">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="Amount">Amounts:</label>
        <input type="text" id="email" name="email" required>
        <br>
        <button type="submit">Submit</button>
    </form>

    @if (session('response'))
        <h3>Response from Receiver:</h3>
        <pre>{{ json_encode(session('response'), JSON_PRETTY_PRINT) }}</pre>
    @endif
</body>

</html>
