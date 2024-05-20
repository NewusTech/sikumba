<table class="table align-items-center mb-5">
    <thead class="thead-light table-bordered">
        <tr>
            <th class="border text-center">Name</th>
            <th class="border text-center">Commodity</th>
            <th class="border text-center">Date</th>
            <th class="border text-center">Sealing Mark</th>
            <th class="border text-center">Report Sealing</th>
            <th class="border text-center">Consignment Commodity</th>
            <th class="border text-center">Identification</th>
            <th class="border text-center">Exporting Comp</th>
            <th class="border text-center">Address</th>
            <th class="border text-center">Regist Number</th>
            <th class="border text-center">Type Packing</th>
            <th class="border text-center">Qty Package</th>
            <th class="border text-center">Weight</th>
            <th class="border text-center">Volume</th>
            <th class="border text-center">Type</th>
            <th class="border text-center">Status</th>
            @if ($rolename->name != 'Analis')
                <th class="border text-center">Sertifikat</th>
                <th class="border text-center">Laporan Hasil <br> Analisa</th>
            @endif
            <th class="border text-center">Laporan Dari <br> Analis</th>
            <th class="border text-center">Action</th>
        </tr>
    </thead>
    <tbody class="table-bordered">
        @forelse ($pengajuan as $item)
            <tr>
                <td class="border">{{ $item->name }}</td>
                <td class="border">{{ $item->type_commodity }}</td>
                <td class="border">{{ $item->date }}</td>
                <td class="border">{{ $item->sealing_mark }}</td>
                <td class="border">{{ $item->report_sealing }}</td>
                <td class="border">{{ $item->consignment_commodity }}</td>
                <td class="border">{{ $item->identification }}</td>
                <td class="border">{{ $item->exporting_comp }}</td>
                <td class="border">{{ $item->address }}</td>
                <td class="border">{{ $item->regist_number }}</td>
                <td class="border">{{ $item->type_packing }}</td>
                <td class="border">{{ $item->qty_package }}</td>
                <td class="border">{{ $item->weight }}</td>
                <td class="border">{{ $item->volume }}</td>
                <td class="border">
                    @if ($item->type == 1)
                        Diantar
                    @elseif ($item->type == 2)
                        Diambil
                    @endif
                </td>
                <td class="text-center text-nowrap border">
                    @if (!empty($user) && $user->roles->contains('name', 'Ka. UPTD'))
                        @if ($item->status == 1)
                            <form action="{{ route('approve', ['id' => $item->id]) }}"
                                method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary mb-0"
                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approve?</button>
                            </form>
                        @elseif ($item->status < 1)
                            <span>Menunggu</span>
                        @elseif ($item->status > 1)
                            <span class="text-success">Approved</span>
                        @endif
                    @endif
                    @if ($item->type == 2)
                        {{-- DIambil --}}
                        @if (!empty($user) && $user->roles->contains('name', 'TU'))
                            @if ($item->status === null || $item->status == 0)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Register?</button>
                                </form>
                            @elseif ($item->status > 0 && $item->status < 8)
                                <span class="text-success">Registered</span>
                            @elseif ($item->status == 8)
                                @if ($item->berkas)
                                    <form action="{{ route('approve', ['id' => $item->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mb-0"
                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approval
                                            by UPTD??</button>
                                    </form>
                                @else
                                    <button title="Upload sertifikat terlebih dahulu"
                                        class="btn btn-secondary mb-0">Approval by UPTD??</button>
                                @endif
                            @elseif ($item->status == 9 && $item->admin_confirm == 0)
                                @if ($item->user_confirm == 0)
                                    <span class="text-success">Menunggu <br> Pembayaran</span>
                                @elseif ($item->user_confirm == 1)
                                    <button
                                        onclick="openUploadModalApprove({{ $item->id }}, '{{ $item->bukti_pembayaran_pengujian ? asset('storage/' . $item->bukti_pembayaran_pengujian) : '' }}')"
                                        class="btn btn-primary mb-0">Sudah
                                        membayar... <br> Selesaikan ?</button>
                                @endif
                            @elseif ($item->status == 9 && $item->user_confirm == 1 && $item->admin_confirm == 1)
                                <span class="text-success">Proses Selesai</span>
                            @endif
                        @endif

                        @if (!empty($user) && $user->roles->contains('name', 'Kasi Pengawasan'))
                            @if ($item->status == 2)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Bookkeeping?</button>
                                </form>
                            @elseif ($item->status < 2)
                                <span>Menunggu</span>
                            @elseif ($item->status > 2 && $item->status < 6)
                                <span class="text-success">Bookkeeping</span>
                            @elseif ($item->status == 6)
                                {{-- @if ($item->berkas_laporan) --}}
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approve
                                        test?</button>
                                </form>
                                {{-- @else
                                    <button title="Upload sertifikat terlebih dahulu"
                                        class="btn btn-secondary mb-0">Approve
                                        test?</button>
                                @endif --}}
                            @elseif ($item->status > 6)
                                <span class="text-success">Approve</span>
                            @endif
                        @endif

                        @if (!empty($user) && $user->roles->contains('name', 'PPC'))
                            @if ($item->status == 3)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approve?</button>
                                </form>
                            @elseif ($item->status < 3)
                                <span>Menunggu</span>
                            @elseif ($item->status > 3)
                                <span class="text-success">Approve</span>
                            @endif
                        @endif
                        @if (!empty($user) && $user->roles->contains('name', 'Kasi Sertifikasi'))
                            @if ($item->status == 4)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Ready
                                        to test?</button>
                                </form>
                            @elseif ($item->status < 4)
                                <span>Menunggu</span>
                            @elseif ($item->status > 4 && $item->status < 7)
                                <span class="text-success">Ready to test</span>
                            @elseif ($item->status == 7)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approve
                                        result?</button>
                                </form>
                            @elseif ($item->status > 7)
                                <span class="text-success">Approve</span>
                            @endif
                        @endif
                        @if (!empty($user) && $user->roles->contains('name', 'Analis'))
                            @if ($item->status == 5)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approve
                                        Test?</button>
                                </form>
                            @elseif ($item->status < 5)
                                <span>Menunggu</span>
                            @elseif ($item->status > 5)
                                <span class="text-success">Approve Test</span>
                            @endif
                        @endif
                    @endif

                    @if ($item->type == 1)
                        {{-- DIantar --}}
                        @if (!empty($user) && $user->roles->contains('name', 'TU'))
                            @if ($item->status === null || $item->status == 0)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Register?</button>
                                </form>
                            @elseif ($item->status > 0 && $item->status < 7)
                                <span class="text-success">Registered</span>
                            @elseif ($item->status == 7)
                                @if ($item->berkas)
                                    <form action="{{ route('approve', ['id' => $item->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mb-0"
                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approval
                                            by UPTD??</button>
                                    </form>
                                @else
                                    <button title="Upload sertifikat terlebih dahulu"
                                        class="btn btn-secondary mb-0">Approval by UPTD??</button>
                                @endif
                            @elseif ($item->status == 8 && $item->admin_confirm == 0)
                                @if ($item->user_confirm == 0)
                                    <span class="text-success">Menunggu <br> Pembayaran</span>
                                @elseif ($item->user_confirm == 1)
                                    {{-- <form
                                        action="{{ route('approveBayarAdmin', ['id' => $item->id]) }}"
                                        method="post">
                                        @csrf --}}
                                    <button
                                        onclick="openUploadModalApprove({{ $item->id }}, '{{ $item->bukti_pembayaran_pengujian ? asset('storage/' . $item->bukti_pembayaran_pengujian) : '' }}')"
                                        class="btn btn-primary mb-0">Sudah
                                        membayar... <br> Selesaikan ?</button>
                                    {{-- </form> --}}
                                @endif
                            @elseif ($item->status == 8 && $item->user_confirm == 1 && $item->admin_confirm == 1)
                                <span class="text-success">Proses Selesai</span>
                            @endif
                        @endif
                        @if (!empty($user) && $user->roles->contains('name', 'Kasi Pengawasan'))
                            @if ($item->status == 2)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Bookkeeping?</button>
                                </form>
                            @elseif ($item->status < 2)
                                <span>Menunggu</span>
                            @elseif ($item->status > 2 && $item->status < 5)
                                <span class="text-success">Bookkeeping</span>
                            @elseif ($item->status == 5)
                                {{-- @if ($item->berkas_laporan) --}}
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approve
                                        test?</button>
                                </form>
                                {{-- @else
                                    <button title="Upload sertifikat terlebih dahulu"
                                        class="btn btn-secondary mb-0">Approve
                                        test?</button>
                                @endif --}}
                            @elseif ($item->status > 5)
                                <span class="text-success">Approve</span>
                            @endif
                        @endif
                        @if (!empty($user) && $user->roles->contains('name', 'Kasi Sertifikasi'))
                            @if ($item->status == 3)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Ready
                                        to test?</button>
                                </form>
                            @elseif ($item->status < 3)
                                <span>Menunggu</span>
                            @elseif ($item->status > 3 && $item->status < 6)
                                <span class="text-success">Ready to test</span>
                            @elseif ($item->status == 6)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approve
                                        result?</button>
                                </form>
                            @elseif ($item->status > 6)
                                <span class="text-success">Approve</span>
                            @endif
                        @endif
                        @if (!empty($user) && $user->roles->contains('name', 'PPC'))
                            <span>Menunggu</span>
                        @endif
                        @if (!empty($user) && $user->roles->contains('name', 'Analis'))
                            @if ($item->status == 4)
                                <form action="{{ route('approve', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-0"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approve
                                        Test?</button>
                                </form>
                            @elseif ($item->status < 4)
                                <span>Menunggu</span>
                            @elseif ($item->status > 4)
                                <span class="text-success">Approve Test</span>
                            @endif
                        @endif
                    @endif
                </td>
                @if ($rolename->name != 'Analis')
                    @if ($rolename->name == 'TU')
                        <td class="border text-center">
                            <div class="d-flex flex-column">
                                @if ($item->type == 1 && $item->status >= 7)
                                    {{-- DIantar --}}
                                    <button
                                        onclick="openUploadModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-3">Upload
                                        Sertifikat</button>
                                    {{-- @elseif ($item->type == 1 && $item->status >= 8) --}}
                                    {{-- DIantar --}}
                                    {{-- <button
                                    onclick="openCheckModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                    class="btn btn-primary btn-sm m-0 px-3">Lihat
                                    Sertifikat</button> --}}
                                @elseif ($item->type == 2 && $item->status >= 8)
                                    {{-- DIambil --}}
                                    <button
                                        onclick="openUploadModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                        class="btn btn-primary btn-sm mt-1 px-3">Upload
                                        Sertifikat</button>
                                    {{-- @elseif ($item->type == 2 && $item->status >= 9) --}}
                                    {{-- DIambil --}}
                                    {{-- <button
                                    onclick="openCheckModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                    class="btn btn-primary btn-sm m-0 px-3">Lihat
                                    Sertifikat</button> --}}
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                    @elseif ($rolename->name == 'Kasi Sertifikasi')
                        <td class="border text-center">
                            <div class="d-flex flex-column">
                                @if ($item->type == 1 && $item->status >= 6)
                                    <a href="{{ url('/print-pdf', ['id' => $item->id]) }}"
                                        class="mb-0; px-3"
                                        style="font-size: 15px; color: blue">Print
                                        Template</a>
                                    <button
                                        onclick="openCheckModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-3">Lihat
                                        Sertifikat</button>
                                @elseif ($item->type == 2 && $item->status >= 7)
                                    <a href="{{ url('/print-pdf', ['id' => $item->id]) }}"
                                        class="mb-0; px-3"
                                        style="font-size: 15px; color: blue">Print
                                        Template</a>
                                    <button
                                        onclick="openCheckModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-3">Lihat
                                        Sertifikat</button>
                                @endif
                            </div>
                        </td>
                    @else
                        <td class="border text-center">
                            <div class="d-flex flex-column">
                                @if ($item->type == 1 && $item->status >= 8)
                                    {{-- DIantar --}}
                                    <button
                                        onclick="openCheckModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-3">Lihat
                                        Sertifikat</button>
                                @elseif ($item->type == 2 && $item->status >= 9)
                                    {{-- DIambil --}}
                                    <button
                                        onclick="openCheckModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-3">Lihat
                                        Sertifikat</button>
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                    @endif
                    @if ($rolename->name == 'Kasi Pengawasan')
                        <td class="border text-center">
                            <div class="d-flex flex-column">
                                @if ($item->type == 1)
                                    {{-- DIantar --}}
                                    @if ($item->status >= 5)
                                        <a href="{{ url('/print-file-analisa', ['id' => $item->id]) }}"
                                            class="mb-0; px-2"
                                            style="font-size: 15px; color: blue">Print
                                            Template</a>
                                        <button
                                            onclick="openUploadModalLap({{ $item->id }}, '{{ $item->berkas_laporan ? asset('storage/' . $item->berkas_laporan) : '' }}')"
                                            class="btn btn-primary btn-sm mt-1 px-2">Upload
                                            Laporan</button>
                                        {{-- @elseif ($item->status > 5)
                                    <button
                                        onclick="openCheckModalLap({{ $item->id }}, '{{ $item->berkas_laporan ? asset('storage/' . $item->berkas_laporan) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-2">Lihat
                                        Laporan</button> --}}
                                    @else
                                        -
                                    @endif
                                @elseif ($item->type == 2)
                                    {{-- diambil --}}
                                    @if ($item->status >= 6)
                                        <a href="{{ url('/print-file-analisa', ['id' => $item->id]) }}"
                                            class="mb-0; px-2"
                                            style="font-size: 15px; color: blue">Print
                                            Template</a>
                                        <button
                                            onclick="openUploadModalLap({{ $item->id }}, '{{ $item->berkas_laporan ? asset('storage/' . $item->berkas_laporan) : '' }}')"
                                            class="btn btn-primary btn-sm mt-1 px-2">Upload
                                            Laporan</button>
                                        {{-- @elseif ($item->status > 6)
                                    <button
                                        onclick="openCheckModalLap({{ $item->id }}, '{{ $item->berkas_laporan ? asset('storage/' . $item->berkas_laporan) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-2">Lihat
                                        Laporan</button> --}}
                                    @else
                                        -
                                    @endif
                                @endif
                            </div>
                        </td>
                    @else
                        <td class="border text-center">
                            <div class="d-flex flex-column">
                                @if ($item->type == 1)
                                    {{-- DIantar --}}
                                    @if ($item->status > 5)
                                        <button
                                            onclick="openCheckModalLap({{ $item->id }}, '{{ $item->berkas_laporan ? asset('storage/' . $item->berkas_laporan) : '' }}')"
                                            class="btn btn-primary btn-sm m-0 px-o">Lihat
                                            Laporan</button>
                                    @else
                                        -
                                    @endif
                                @elseif ($item->type == 2)
                                    {{-- diambil --}}
                                    @if ($item->status > 6)
                                        <button
                                            onclick="openCheckModalLap({{ $item->id }}, '{{ $item->berkas_laporan ? asset('storage/' . $item->berkas_laporan) : '' }}')"
                                            class="btn btn-primary btn-sm m-0 px-o">Lihat
                                            Laporan</button>
                                    @else
                                        -
                                    @endif
                                @endif
                            </div>
                        </td>
                    @endif
                @endif
                @if ($rolename->name == 'Analis')
                    @if ($item->type == 1)
                        {{-- DIantar --}}
                        <td class="border text-center">
                            <div class="d-flex flex-column">
                                @if ($item->status >= 3)
                                    <button
                                        onclick="openUploadModalAnalis({{ $item->id }}, '{{ $item->berkas_analis ? asset('storage/' . $item->berkas_analis) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-0">Upload
                                        Berkas</button>
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                    @endif
                    @if ($item->type == 2)
                        {{-- diambil --}}
                        <td class="border text-center">
                            <div class="d-flex flex-column">
                                @if ($item->status >= 4)
                                    <button
                                        onclick="openUploadModalAnalis({{ $item->id }}, '{{ $item->berkas_analis ? asset('storage/' . $item->berkas_analis) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-0">Upload
                                        Berkas</button>
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                    @endif
                @else
                    <td class="border text-center">
                        <div class="d-flex flex-column">
                            @if ($item->type == 1)
                                @if ($item->status > 4)
                                    <button
                                        onclick="openCheckModalAnalis({{ $item->id }}, '{{ $item->berkas_analis ? asset('storage/' . $item->berkas_analis) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-o">Lihat
                                        Berkas</button>
                                @else
                                    -
                                @endif
                            @endif
                            @if ($item->type == 2)
                                @if ($item->status > 5)
                                    <button
                                        onclick="openCheckModalAnalis({{ $item->id }}, '{{ $item->berkas_analis ? asset('storage/' . $item->berkas_analis) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-o">Lihat
                                        Berkas</button>
                                @else
                                    -
                                @endif
                            @endif
                        </div>
                    </td>
                @endif
                <td class="border text-center text-nowrap px-2 d-flex flex-column">
                    <a href="{{ route('history-pengajuan.edit', $item->id) }}"
                        class="btn btn-primary btn-sm m-0 px-3">Edit Form</a>
                    @if ($rolename->name == 'Kasi Sertifikasi')
                        <a href="{{ route('history-pengajuan.sertif', $item->id) }}"
                            class="btn btn-primary btn-sm mt-2 mb-0 px-3">Edit Sertifikat</a>
                    @endif
                    @if ($rolename->name == 'Kasi Pengawasan')
                        <a href="{{ route('history-pengajuan.laporan', $item->id) }}"
                            class="btn btn-primary btn-sm mt-2 mb-0 px-3">Edit Laporan</a>
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