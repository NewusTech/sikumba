<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Name</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Rating</th>
            <th>Comment</th>
        </tr>
        @foreach ($survey as $item)
        <tr>
            <td style="border: 1px">{{ $item->name }}</td>
            <td style="border: 1px">{{ $item->no_handphone }}</td>
            <td style="border: 1px">{{ $item->email }}</td>
            <td style="border: 1px">{{ $item->alamat }}</td>
            <td style="border: 1px">{{ $item->rating }}</td>
            <td style="border: 1px">{{ $item->comments }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
