<table class="table align-items-center mb-5">
    <thead class="thead-light table-bordered">
        <tr>
            <th class="border text-center">Name</th>
            <th class="border text-center">Date</th>
            <th class="border text-center">No. HP</th>
            <th class="border text-center">Penilaian</th>
            <th class="border text-center">Komentar</th>
        </tr>
    </thead>
    <tbody class="table-bordered">
        @forelse ($survey as $item)
            <tr>
                <td class="border">{{ $item->name }}</td>
                <td class="border">{{ $item->created_at }}</td>
                <td class="border">{{ $item->no_handphone }}</td>
                <td class="border">
                    @if ($item->rating == 'sangat_memuaskan')
                        sangat memuaskan
                    @elseif($item->rating == 'cukup_memuaskan')
                        cukup memuaskan
                    @else
                        {{ $item->rating }}
                    @endif
                </td>
                <td class="border">{{ $item->comments }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="16" class="font-weight-bold border text-center">Tidak ada data yang
                    dapat ditampilkan</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div id="pagination">
    {{ $survey->links('vendor.pagination.bootstrap-4') }}
</div>
