<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
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
            <th>Date</th>
            <th>Address</th>
            <th>Nama Alat</th>
            <th>Merk Alat</th>
            <th>Serial Number</th>
            <th>Kapasitas</th>
            <th>Area Kalibrasi</th>
        </tr>
        @foreach ($kalibrasi as $item)
        <tr>
            <td style="border: 1px">{{ $item->name }}</td>
            <td style="border: 1px">{{ $item->date }}</td>
            <td style="border: 1px">{{ $item->address }}</td>
            <td style="border: 1px">{{ $item->nama_alat }}</td>
            <td style="border: 1px">{{ $item->merek_alat }}</td>
            <td style="border: 1px">{{ $item->serial_number_alat }}</td>
            <td style="border: 1px">{{ $item->kapasitas }}</td>
            <td style="border: 1px">{{ $item->area_kalibrasi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
