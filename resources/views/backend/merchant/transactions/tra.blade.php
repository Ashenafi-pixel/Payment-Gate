<!-- app/resources/views/transactions/index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Table</title>
    <!-- Include any additional styling if needed -->
</head>

<body>

    <h2>Transaction Table</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Date</th>
                <!-- Add more headers as needed -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allTransactions as $transaction): ?>
            <tr>
                <td><?= $transaction['transaction_id'] ?></td>
                <td><?= $transaction['amount'] ?></td>
                <td><?= $transaction['date'] ?></td>
                <!-- Add more cells as needed -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>
