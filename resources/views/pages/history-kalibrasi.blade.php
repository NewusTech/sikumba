@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Riwayat'])

    <!-- File Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadForm" action="{{ url('/history-kalibrasi/upload') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="kalibrasi_id" id="kalibrasi_id">
                        <div class="form-group">
                            <label for="berkas">Choose</label>
                            <input type="file" class="form-control" id="berkas" name="berkas"
                                onchange="previewFile(this);" accept="application/pdf">

                            <embed id="previewPdf" src="" type="application/pdf"
                                style="width: 100%; height: 500px; display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- File Check Modal -->
    <div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="checkModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkModalLabel">Berkas</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="berkas">Berkas</label>

                        <embed id="previewPdf2" src="" type="application/pdf"
                            style="width: 100%; height: 500px; display: none;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- File Upload Modal Lap -->
    <div class="modal fade" id="uploadModalLap" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabelLap"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabelLap">Upload</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadFormLap" action="{{ url('/history-kalibrasi/uploadLaporan') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="kalibrasi_idLap" id="kalibrasi_idLap">
                        <div class="form-group">
                            <label for="berkas_laporan">Choose</label>
                            <input type="file" class="form-control" id="berkas_laporan" name="berkas_laporan"
                                onchange="previewFileLap(this);" accept=".pdf, .jpg, .jpeg, .png">

                            <img id="previewImgLap" src="" style="max-width: 100%; display: none;">
                            <embed id="previewPdfLap" src="" type="application/pdf"
                                style="width: 100%; height: 500px; display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- File Check Modal Lap-->
    <div class="modal fade" id="checkModalLap" tabindex="-1" role="dialog" aria-labelledby="checkModalLabelLap"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkModalLabelLap">Berkas</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="berkas_laporan">Berkas</label>

                        <img id="previewImgLap2" src="" style="max-width: 100%; display: none;">
                        <embed id="previewPdfLap2" src="" type="application/pdf"
                            style="width: 100%; height: 500px; display: none;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- File Upload Modal Analis -->
    <div class="modal fade" id="uploadModalAnalis" tabindex="-1" role="dialog"
        aria-labelledby="uploadModalLabelAnalis" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabelAnalis">Upload</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadFormAnalis" action="{{ url('/history-kalibrasi/uploadAnalis') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="kalibrasi_idAnalis" id="kalibrasi_idAnalis">
                        <div class="form-group">
                            <label for="berkas_analis">Choose</label>
                            <small style="font-size: small">(PDF / Foto / Excel / Word)</small>
                            <input type="file" class="form-control" id="berkas_analis" name="berkas_analis"
                                onchange="previewFileAnalis(this);"
                                accept=".pdf, .doc, .docx, .xls, .xlsx, .jpg, .jpeg, .png">

                            <img id="previewImgAnalis" src="" style="max-width: 100%; display: none;">
                            <embed id="previewPdfAnalis" src="" type="application/pdf"
                                style="width: 100%; height: 500px; display: none;">
                            <a id="previewWordLinkAnalis" href="#"
                                style="display: none; color: rgb(0, 140, 255); font-size: 13px" download>Download Word
                                File</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- File Check Modal Analis-->
    <div class="modal fade" id="checkModalAnalis" tabindex="-1" role="dialog" aria-labelledby="checkModalLabelAnalis"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkModalLabelAnalis">Berkas</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="berkas_analis">Berkas</label>
                        <img id="previewImgAnalis2" src="" style="max-width: 100%; display: none;">
                        <embed id="previewPdfAnalis2" src="" type="application/pdf"
                            style="width: 100%; height: 500px; display: none;">
                        <a id="previewWordLinkAnalis2" href="#"
                            style="display: none; color: rgb(0, 140, 255); font-size: 13px" download>Download Word File</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- APROVE BAYAR ADMIN-->
    <div class="modal fade" id="uploadModalApprove" tabindex="-1" role="dialog"
        aria-labelledby="uploadModalLabelApprove" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabelApprove">Upload</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadForm" action="{{ route('approvekalibrasiBayarAdmin') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="bukti_id" id="bukti_id">
                        <div class="form-group">
                            <label for="berkas">Bukti Pembayaran</label>
                            <embed id="previewPdfApprove" src="" type="application/pdf"
                                style="width: 100%; height: 500px; display: none;">
                            <div id="imagePreviewApprove" style="display: none;">
                                <img id="previewImage" src="" style="max-width: 100%; display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Setujui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-0 mx-1">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                    <div>
                        <h6 class="mt-1">Riwayat Kalibrasi</h6>
                    </div>
                    <div>
                        <form class="d-flex align-items-center">
                            <input id="search" class="form-control mr-5" type="text" name="search"
                                placeholder="Search...">
                        </form>
                    </div>
                </div>
                <div class="card-header py-0 mt-2">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 mb-2">
                            <small class="d-block">Tanggal Awal</small>
                            <input class="form-control" type="date" id="dateawal" name="dateawal">
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <small class="d-block">Tanggal Akhir</small>
                            <input class="form-control" type="date" id="dateakhir" name="dateakhir">
                        </div>
                    </div>
                    <div class="text-start">
                        <a id="export-button" href="{{ route('export-history-kalibrasi') }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3" id="search-list">
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
                                                    <button
                                                        onclick="openUploadModalApprove({{ $item->id }}, '{{ $item->bukti_pembayaran_kalibrasi ? asset('storage/' . $item->bukti_pembayaran_kalibrasi) : '' }}')"
                                                        class="btn btn-primary mb-0">Sudah
                                                        membayar... <br> Selesaikan ?</button>
                                                @elseif ($item->status == 8 && $item->admin_confirm == 1)
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle live search
            $('#search').on('keyup', function() {
                fetch_data();
            });

            $('#dateawal').on('change', function() {
                fetch_data();
            });

            $('#dateakhir').on('change', function() {
                fetch_data();
            });

            // Handle pagination links
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            // Fetch data function
            function fetch_data(page = 1) {
                var query = $('#search').val();
                var dateawal = $('#dateawal').val();
                var dateakhir = $('#dateakhir').val();
                var baseUrl = "{!! url('/history-kalibrasi/search') !!}?query=" + query + "&dateawal=" +
                    dateawal + "&dateakhir=" + dateakhir;
                $.ajax({
                    url: baseUrl,
                    type: 'GET',
                    data: {
                        page: page,
                    },
                    success: function(data) {
                        $('#search-list').html(data);
                    }
                });
            }
        });
    </script>

    <script>
        document.getElementById('export-button').addEventListener('click', function() {
            var search = document.getElementById('search').value;
            var dateawal = document.getElementById('dateawal').value;
            var dateakhir = document.getElementById('dateakhir').value;
            var exportUrl = this.getAttribute('href') + '?searchh=' + search + "&dateawal=" + dateawal +
                "&dateakhir=" + dateakhir;
            this.setAttribute('href', exportUrl);
        });
    </script>

    <script>
        function openUploadModal(id, pdfUrl) {
            // Reset form dan pratinjau ketika membuka modal
            $('#uploadForm').trigger('reset');
            $('#previewPdf').hide(); // Sembunyikan pratinjau PDF terlebih dahulu

            if (pdfUrl) {
                $('#previewPdf').attr('src', pdfUrl).show(); // Tampilkan pratinjau PDF jika URL ada
            }

            $('#kalibrasi_id').val(id);
            $('#uploadModal').modal('show');
        }

        function openCheckModal(id, pdfUrl) {
            $('#uploadForm').trigger('reset');
            $('#previewPdf2').hide();
            if (pdfUrl) {
                $('#previewPdf2').attr('src', pdfUrl).show();
            }

            $('#kalibrasi_id').val(id);
            $('#checkModal').modal('show');
        }

        $('#uploadModal').on('hidden.bs.modal', function() {
            $('#uploadForm').trigger('reset');
            $('#previewPdf').hide().attr('src', ''); // Menyembunyikan dan menghapus sumber pratinjau PDF
        });

        function previewFile(input) {
            var file = input.files[0];
            if (file.type === "application/pdf") {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewPdf').attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        function openUploadModalLap(id, pdfUrl) {
            // Reset form dan pratinjau ketika membuka modal
            $('#uploadFormLap').trigger('reset');
            $('#previewPdfLap').hide(); // Sembunyikan pratinjau PDF terlebih dahulu
            $('#previewImgLap').hide().attr('src', '');

            if (pdfUrl) {
                var fileExtension = pdfUrl.split('.').pop().toLowerCase();

                if (fileExtension === 'pdf') {
                    $('#previewPdfLap').attr('src', pdfUrl).show();
                } else if (['jpg', 'jpeg', 'png', 'webp'].includes(fileExtension)) {
                    $('#previewImgLap').attr('src', pdfUrl).show();
                }
            }

            $('#kalibrasi_idLap').val(id);
            $('#uploadModalLap').modal('show');
        }

        function openCheckModalLap(id, fileUrl) {
            $('#uploadFormLap').trigger('reset');
            $('#previewPdfLap2').hide()
            $('#previewImgLap2').hide();

            // Menentukan jenis file berdasarkan ekstensi
            var fileExtension = fileUrl.split('.').pop().toLowerCase();

            if (fileUrl) {
                if (fileExtension === 'pdf') {
                    $('#previewPdfLap2').attr('src', fileUrl).show();
                    $('#previewImgLap2').hide();
                } else if (fileExtension === 'jpg' || fileExtension === 'png' || fileExtension === 'jpeg' ||
                    fileExtension === 'webp') {
                    $('#previewImgLap2').attr('src', fileUrl).show();
                    $('#previewPdfLap2').hide();
                }
            }

            $('#pengajuan_idLap').val(id);
            $('#checkModalLap').modal('show');
        }

        $('#uploadModalLap').on('hidden.bs.modal', function() {
            $('#uploadFormLap').trigger('reset');
            $('#previewImgLap').hide().attr('src', '');
            $('#previewPdfLap').hide().attr('src', ''); // Menyembunyikan dan menghapus sumber pratinjau PDF
        });

        function previewFileLap(input) {
            var file = input.files[0];
            var fileExtension = file.name.split('.').pop().toLowerCase();
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#previewPdfLap').hide().attr('src', '');
                $('#previewImgLap').hide().attr('src', '');

                if (file.type === "application/pdf") {
                    $('#previewPdfLap').attr('src', e.target.result).show();
                } else if (['jpg', 'jpeg', 'png', 'webp'].includes(fileExtension)) {
                    $('#previewImgLap').attr('src', e.target.result).show();
                }
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        function openUploadModalAnalis(id, fileUrl) {
            // Reset form dan pratinjau ketika membuka modal
            $('#uploadFormAnalis').trigger('reset');
            $('#previewPdfAnalis').hide(); // Sembunyikan pratinjau PDF terlebih dahulu
            $('#previewWordLinkAnalis').hide().attr('src', ''); // Sembunyikan dan kosongkan pratinjau Word
            $('#previewImgAnalis').hide().attr('src', ''); // Sembunyikan dan kosongkan pratinjau gambar

            // Menentukan jenis file berdasarkan ekstensi
            var fileExtension = fileUrl.split('.').pop().toLowerCase();

            if (fileUrl) {
                if (fileExtension === 'pdf') {
                    $('#previewPdfAnalis').attr('src', fileUrl).show();
                    $('#previewWordAnalis').hide();
                } else {
                    $('#previewWordAnalis').attr('src', fileUrl).show();
                    $('#previewPdfAnalis').hide();
                }

                if (fileExtension === 'pdf') {
                    $('#previewPdfAnalis').attr('src', fileUrl).show();
                } else if (['jpg', 'jpeg', 'png', 'webp'].includes(fileExtension)) {
                    $('#previewImgAnalis').attr('src', fileUrl).show();
                } else {
                    $('#previewWordLinkAnalis').attr('href', fileUrl).text("Download Berkas").show();
                }
            }

            $('#kalibrasi_idAnalis').val(id);
            $('#uploadModalAnalis').modal('show');
        }

        function openCheckModalAnalis(id, fileUrl) {
            $('#uploadFormAnalis').trigger('reset');
            $('#previewPdfAnalis2').hide();
            $('#previewWordLinkAnalis2').hide();
            $('#previewImgAnalis2').hide();

            // Menentukan jenis file berdasarkan ekstensi
            var fileExtension = fileUrl.split('.').pop().toLowerCase();

            if (fileUrl) {
                if (fileExtension === 'pdf') {
                    $('#previewPdfAnalis2').attr('src', fileUrl).show();
                    $('#previewWordLinkAnalis2').hide();
                    $('#previewImgAnalis2').hide();
                } else if (fileExtension === 'jpg' || fileExtension === 'png' || fileExtension === 'jpeg' ||
                    fileExtension === 'webp') {
                    $('#previewImgAnalis2').attr('src', fileUrl).show();
                    $('#previewWordLinkAnalis2').hide();
                    $('#previewPdfAnalis2').hide();
                } else {
                    $('#previewWordLinkAnalis2').attr('href', fileUrl).text("Download").show();
                    $('#previewPdfAnalis2').hide();
                    $('#previewImgAnalis2').hide();
                }
            }

            $('#kalibrasi_idAnalis').val(id);
            $('#checkModalAnalis').modal('show');
        }


        $('#uploadModalAnalis').on('hidden.bs.modal', function() {
            $('#uploadFormAnalis').trigger('reset');
            $('#previewPdfAnalis').hide().attr('src', ''); // Menyembunyikan dan menghapus sumber pratinjau PDF
        });

        function previewFileAnalis(input) {
            var file = input.files[0];
            if (file.type === "application/pdf") {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewPdfAnalis').attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        function openUploadModalApprove(id, pdfUrl) {
            // Reset form dan pratinjau ketika membuka modal
            $('#uploadFormApprove').trigger('reset');
            $('#previewPdfApprove').hide(); // Sembunyikan pratinjau PDF terlebih dahulu

            if (pdfUrl) {
                $('#previewPdfApprove').attr('src', pdfUrl).show(); // Tampilkan pratinjau PDF jika URL ada
            }

            $('#bukti_id').val(id);
            $('#uploadModalApprove').modal('show');
        }

        $('#uploadModalApprove').on('hidden.bs.modal', function() {
            $('#uploadFormApprove').trigger('reset');
            $('#previewPdfApprove').hide().attr('src', ''); // Menyembunyikan dan menghapus sumber pratinjau PDF
        });


        function previewFileApprove(input) {
            var file = input.files[0];
            var previewPdfApprove = document.getElementById('previewPdfApprove');
            var previewImageApprove = document.getElementById('previewImageApprove');
            var imagePreviewApprove = document.getElementById('imagePreviewApprove');

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    if (file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/png') {
                        // Tampilkan pratinjau jika file adalah gambar JPG
                        previewPdfApprove.style.display = 'none';
                        previewImageApprove.src = e.target.result;
                        imagePreviewApprove.style.display = 'block';
                    } else if (file.type === 'application/pdf') {
                        // Tampilkan pratinjau jika file adalah PDF
                        previewImageApprove.src = '';
                        imagePreviewApprove.style.display = 'none';
                        previewPdfApprove.src = e.target.result;
                        previewPdfApprove.style.display = 'block';
                    } else {
                        // Sembunyikan pratinjau jika bukan gambar JPG atau PDF
                        previewImageApprove.src = '';
                        imagePreviewApprove.style.display = 'none';
                        previewPdfApprove.src = '';
                        previewPdfApprove.style.display = 'none';
                        // Tampilkan pesan bahwa file tidak didukung
                        alert('Unsupported file format. Please select a JPG image or PDF file.');
                    }
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
