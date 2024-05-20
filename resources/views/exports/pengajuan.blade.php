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
            <th>Commodity</th>
            <th>Sealing Mark</th>
            <th>Report Sealing</th>
            <th>Consignment Commodity</th>
            <th>Identification</th>
            <th>Exporting Comp</th>
            <th>Address</th>
            <th>Regist Number</th>
            <th>Type Packing</th>
            <th>Qty Package</th>
            <th>Weight</th>
            <th>Volume</th>
            <th>Type</th>
        </tr>
        @foreach ($pengajuan as $item)
        <tr>
            <td style="border: 1px">{{ $item->name }}</td>
            <td style="border: 1px">{{ $item->date }}</td>
            <td style="border: 1px">{{ $item->type_commodity }}</td>
            <td style="border: 1px">{{ $item->sealing_mark }}</td>
            <td style="border: 1px">{{ $item->report_sealing }}</td>
            <td style="border: 1px">{{ $item->consignment_commodity }}</td>
            <td style="border: 1px">{{ $item->identification }}</td>
            <td style="border: 1px">{{ $item->exporting_comp }}</td>
            <td style="border: 1px">{{ $item->address }}</td>
            <td style="border: 1px">{{ $item->regist_number }}</td>
            <td style="border: 1px">{{ $item->type_packing }}</td>
            <td style="border: 1px">{{ $item->qty_package }}</td>
            <td style="border: 1px">{{ $item->weight }}</td>
            <td style="border: 1px">{{ $item->volume }}</td>
            <td style="border: 1px">
                @if ($item->type == 1)
                    Diantar
                @elseif ($item->type == 2)
                    Diambil
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
