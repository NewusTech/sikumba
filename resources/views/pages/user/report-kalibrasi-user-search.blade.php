<table class="table align-items-center mb-5">
    <thead class="thead-light table-bordered">
        <tr>
            <th class="border">Name</th>
            <th class="border">Date</th>
            <th class="border">Address</th>
            <th class="border">Nama Alat</th>
            <th class="border">Merk Alat</th>
            <th class="border">Serial Number</th>
            <th class="border">Kapasitas</th>
            <th class="border">Area Kalibrasi</th>
            <th class="border text-center">Status</th>
            <th class="border text-center">Berkas</th>
        </tr>
    </thead>
    <tbody class="table-bordered">
        @forelse ($kalibrasi as $item)
            <tr>
                <td class="border">{{ $item->name }}</td>
                <td class="border">{{ $item->date }}</td>
                <td class="border">{{ $item->address }}</td>
                <td class="border">{{ $item->nama_alat }}</td>
                <td class="border">{{ $item->merek_alat }}</td>
                <td class="border">{{ $item->serial_number_alat }}</td>
                <td class="border">{{ $item->kapasitas }}</td>
                <td class="border">{{ $item->area_kalibrasi }}</td>
                <td class="text-center text-nowrap border">
                    @if ($item->status == 8)
                        @if ($item->user_confirm == 0)
                            {{-- <form
                                action="{{ route('approvekalibrasiBayar', ['id' => $item->id]) }}"
                                method="post">
                                @csrf --}}
                                <button
                                    onclick="openUploadModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                    class="btn btn-primary mb-0">Konfirmasi<br>
                                    Pembayaran</button>
                            {{-- </form> --}}
                        @elseif ($item->user_confirm == 1)
                            @if ($item->admin_confirm == 0)
                                <span>Menunggu konfimrasi <br> pembayaran</span>
                            @elseif($item->admin_confirm == 1)
                                <span class="text-success">Proses selesai</span>
                            @endif
                        @endif
                    @else
                        <span>Sedang diproses</span>
                    @endif

                </td>
                <td class="text-center text-nowrap border">
                    @if ($item->status == 8 && $item->user_confirm == 1 && $item->admin_confirm == 1)
                        @if ($item->done_survey == 0)
                            <button type="button" class="btn btn-primary mt-3"
                                data-toggle="modal" data-target="#surveyModal"
                                data-id="{{ $item->id }}">
                                Kirim Survey
                            </button>
                        @else
                            @if ($item->berkas)
                                <a href="{{ asset('storage/' . $item->berkas) }}"
                                    class="mb-0 btn btn-primary" target="_blank">Print
                                    Sertifikat</a>
                                <br>
                            @endif
                            @if ($item->berkas_laporan)
                                <a href="{{ asset('storage/' . $item->berkas_laporan) }}"
                                    class="mt-2 mb-0 btn btn-primary" target="_blank">Print
                                    Laporan
                                    Analisa</a>
                            @endif
                            @if ($item->berkas_laporan == null && $item->berkas == null)
                                -
                            @endif
                        @endif
                    @else
                        <span>Sedang diproses</span>
                    @endif

                </td>
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
    {{ $kalibrasi->links('vendor.pagination.bootstrap-4') }}
</div>