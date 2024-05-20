<table class="table align-items-center mb-5">
    <thead class="thead-light table-bordered">
        <tr>
            <th class="border text-center">Name</th>
            <th class="border text-center">Date</th>
            <th class="border text-center">Address</th>
            <th class="border text-center">Nama Alat</th>
            <th class="border text-center">Merk Alat</th>
            <th class="border text-center">Serial Number</th>
            <th class="border text-center">Kapasitas</th>
            <th class="border text-center">Area Kalibrasi</th>
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
                    @if (!empty($user) && $user->roles->contains('name', 'Ka. UPTD'))
                        @if ($item->status == 1)
                            <form action="{{ route('approvekalibrasi', ['id' => $item->id]) }}"
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
                    @if (!empty($user) && $user->roles->contains('name', 'TU'))
                        @if ($item->status === null || $item->status == 0)
                            <form action="{{ route('approvekalibrasi', ['id' => $item->id]) }}"
                                method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary mb-0"
                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Register?</button>
                            </form>
                        @elseif ($item->status > 0 && $item->status < 7)
                            <span class="text-success">Registered</span>
                        @elseif ($item->status == 7)
                            {{-- @if ($item->berkas) --}}
                            <form action="{{ route('approvekalibrasi', ['id' => $item->id]) }}"
                                method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary mb-0"
                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approval
                                    by UPTD??</button>
                            </form>
                            {{-- @else
                                    <button title="Upload sertifikat terlebih dahulu"
                                        class="btn btn-secondary mb-0">Approval by UPTD??</button>
                                @endif --}}
                        @elseif ($item->status == 8 && $item->admin_confirm == 0)
                            @if ($item->user_confirm == 0)
                                <span class="text-success">Menunggu <br> Pembayaran</span>
                            @elseif ($item->user_confirm == 1)
                                <button
                                    onclick="openUploadModalApprove({{ $item->id }}, '{{ $item->bukti_pembayaran_kalibrasi ? asset('storage/' . $item->bukti_pembayaran_kalibrasi) : '' }}')"
                                    class="btn btn-primary mb-0">Sudah
                                    membayar... <br> Selesaikan ?</button>
                            @endif
                        @elseif ($item->status == 8 && $item->user_confirm == 1 && $item->admin_confirm == 1)
                            <span class="text-success">Proses Selesai</span>
                        @endif
                    @endif
                    @if (!empty($user) && $user->roles->contains('name', 'Kasi Pengawasan'))
                        @if ($item->status == 2)
                            <form action="{{ route('approvekalibrasi', ['id' => $item->id]) }}"
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
                            <form action="{{ route('approvekalibrasi', ['id' => $item->id]) }}"
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
                            <form action="{{ route('approvekalibrasi', ['id' => $item->id]) }}"
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
                            <form action="{{ route('approvekalibrasi', ['id' => $item->id]) }}"
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
                            <form action="{{ route('approvekalibrasi', ['id' => $item->id]) }}"
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
                </td>
                @if ($rolename->name != 'Analis')
                    @if ($rolename->name == 'TU')
                        <td class="border text-center">
                            <div class="d-flex flex-column">
                                @if ($item->status >= 7)
                                    <button
                                        onclick="openUploadModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                        class="btn btn-primary mb-0">Upload
                                        Sertifikat</button>
                                    {{-- @elseif ($item->status >= 8)
                                <button
                                    onclick="openCheckModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                    class="btn btn-primary btn-sm m-0 px-3">Lihat
                                    Sertifikat</button> --}}
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                    @else
                        <td class="border text-center">
                            <div class="d-flex flex-column">
                                @if ($item->status >= 8)
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
                                @if ($item->status >= 5)
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
                            </div>
                        </td>
                    @else
                        <td class="border text-center">
                            <div class="d-flex flex-column">
                                @if ($item->status > 5)
                                    <button
                                        onclick="openCheckModalLap({{ $item->id }}, '{{ $item->berkas_laporan ? asset('storage/' . $item->berkas_laporan) : '' }}')"
                                        class="btn btn-primary btn-sm m-0 px-o">Lihat
                                        Laporan</button>
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                    @endif
                @endif
                @if ($rolename->name == 'Analis')
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
                @else
                    <td class="border text-center">
                        <div class="d-flex flex-column">
                            @if ($item->status > 4)
                                <button
                                    onclick="openCheckModalAnalis({{ $item->id }}, '{{ $item->berkas_analis ? asset('storage/' . $item->berkas_analis) : '' }}')"
                                    class="btn btn-primary btn-sm m-0 px-o">Lihat
                                    Berkas</button>
                            @else
                                -
                            @endif
                        </div>
                    </td>
                @endif
                <td class="border text-center px-2">
                    <a href="{{ route('history-kalibrasi.edit', $item->id) }}"
                        class="btn btn-primary btn-sm m-0 px-3">Edit Form</a>
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