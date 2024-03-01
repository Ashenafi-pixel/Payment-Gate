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
            <td>
                @if (!empty($data['OwnerTIN']))
                    {{ $data['OwnerTIN'] }}
                @else
                    No OwnerTIN available
                @endif
            </td>

            <td>
                @if (!empty($data['TradeName']))
                    {{ $data['TradeName'] }}
                @else
                    No TradeName available
                @endif
            </td>

            <td>
                @if (!empty($data['DateRegistered']))
                    {{ $data['DateRegistered'] }}
                @else
                    No Date Registered available
                @endif
            </td>

            <!-- Access other data array elements in the same way -->
        </tr>
    </tbody>
</table>
