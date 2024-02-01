<table border="1">
    <thead>
        <tr>
            <th>Owner TIN</th>
            <th> Trade Name</th>
            <th>Date Registered</th>
            <!-- Add more table headers as needed -->
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $data['OwnerTIN'] }}</td>
            <td>{{ $data['TradeName'] }}</td>
            <td>{{ $data['DateRegistered'] }}</td>

            <!-- Access other data array elements in the same way -->
        </tr>
    </tbody>
</table>
