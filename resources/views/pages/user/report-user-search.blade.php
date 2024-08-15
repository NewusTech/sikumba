<table class="table align-items-center mb-5">
    <thead class="thead-light table-bordered">
        <tr>
            <th class="border">Name</th>
            <th class="border">Date</th>
            <th class="border">Commodity</th>
            <th class="border">Identification</th>
            <th class="border">Exporting Comp</th>
            <th class="border">Regist Number</th>
            <th class="border">Type Packing</th>
            <th class="border text-center">Type</th>
            <th class="border text-center">Biaya</th>
            <th class="border text-center">Status</th>
            <th class="border text-center">Berkas</th>
        </tr>
    </thead>
    <tbody class="table-bordered">
        @forelse ($pengajuan as $item)
            <tr>
                <td class="border">{{ $item->name }}</td>
                <td class="border">{{ $item->date }}</td>
                <td class="border">{{ $item->type_commodity }}</td>
                <td class="border">{{ $item->identification }}</td>
                <td class="border">{{ $item->exporting_comp }}</td>
                <td class="border">{{ $item->regist_number }}</td>
                <td class="border">{{ $item->type_packing }}</td>
                <td class="border">
                    @if ($item->type == 1)
                        Diantar
                    @elseif ($item->type == 2)
                        Diambil
                    @endif
                </td>
                <td class="text-center text-nowrap border">
                    @if ($item->biaya)
                        <a href="{{ asset('storage/' . $item->biaya) }}" class="mb-0 btn btn-success"
                            target="_blank">Biaya</a>
                        <br>
                    @else
                        -
                    @endif
                </td>
                <td class="text-center text-nowrap border">
                    @if ($item->type == 1)
                        {{-- DIantar --}}
                        @if ($item->status == 8)
                            @if ($item->admin_confirm == 0)
                                <button
                                    onclick="openUploadModal({{ $item->id }}, '{{ $item->bukti_pembayaran_pengujian ? asset('storage/' . $item->bukti_pembayaran_pengujian) : '' }}')"
                                    class="btn btn-primary mb-0">Konfirmasi
                                    Pembayaran</button>
                            @elseif ($item->admin_confirm == 1)
                                <span class="text-success">Proses selesai</span>
                            @endif
                        @else
                            <span>Sedang diproses</span>
                        @endif
                    @elseif ($item->type == 2)
                        {{-- DIambil --}}
                        @if ($item->status == 9)
                            @if ($item->admin_confirm == 0)
                                <button
                                    onclick="openUploadModal({{ $item->id }}, '{{ $item->bukti_pembayaran_pengujian ? asset('storage/' . $item->bukti_pembayaran_pengujian) : '' }}')"
                                    class="btn btn-primary mb-0">Konfirmasi
                                    Pembayaran</button>
                            @elseif ($item->admin_confirm == 1)
                                <span class="text-success">Proses selesai</span>
                            @endif
                        @else
                            <span>Sedang diproses</span>
                        @endif
                    @endif
                </td>
                <td class="text-center text-nowrap border">
                    @if ($item->type == 1)
                        @if ($item->status == 8 && $item->user_confirm == 1 && $item->admin_confirm == 1)
                            @if ($item->done_survey == 0)
                                <button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                                    data-target="#surveyModal" data-id="{{ $item->id }}">
                                    Kirim Survey
                                </button>
                            @else
                                @if ($item->berkas)
                                    <a href="{{ asset('storage/' . $item->berkas) }}" class="mb-0 btn btn-primary"
                                        target="_blank">Print
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
                    @elseif ($item->type == 2)
                        @if ($item->status == 9 && $item->user_confirm == 1 && $item->admin_confirm == 1)
                            @if ($item->done_survey == 0)
                                <button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                                    data-target="#surveyModal" data-id="{{ $item->id }}">
                                    Kirim Survey
                                </button>
                            @else
                                @if ($item->berkas)
                                    <a href="{{ asset('storage/' . $item->berkas) }}" class="mb-0 btn btn-primary"
                                        target="_blank">Print
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
    {{ $pengajuan->links('vendor.pagination.bootstrap-4') }}
</div>
