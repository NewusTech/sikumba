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
                <form id="uploadForm" action="{{ url('/history-pengajuan/upload') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="pengajuan_id" id="pengajuan_id">
                        <div class="form-group">
                            <label for="berkas">Choose</label>
                            <input type="file" class="form-control" id="berkas" name="berkas"
                                onchange="previewFile(this);" accept=".pdf, .jpg, .jpeg, .png">

                            <img id="previewImg" src="" style="max-width: 100%; display: none;">
                            <embed id="previewPdf" src="" type="application/pdf"
                                style="width: 100%; height: 500px; display: none;">
                            <iframe id="previewWord" src="" style="width: 0%; height: 0; display: none;"></iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="deleteFileButton" style="display: none;"
                            onclick="deleteFile()">Delete</button>
                        <button type="submit" class="btn btn-primary" id="uploadButton" disabled>Upload</button>
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

                        <img id="previewImg2" src="" style="max-width: 100%; display: none;">
                        <iframe id="previewWord2" src="" style="width: 0%; height: 0; display: none;"></iframe>
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
                <form id="uploadFormLap" action="{{ url('/history-pengajuan/uploadLaporan') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="pengajuan_idLap" id="pengajuan_idLap">
                        <div class="form-group">
                            <label for="berkas_laporan">Choose</label>
                            <input type="file" class="form-control" id="berkas_laporan" name="berkas_laporan"
                                accept=".pdf, .doc, .docx, .xls, .xlsx, .jpg, .jpeg, .png"
                                onchange="previewFileLap(this);">

                            <img id="previewImgLap" src="" style="max-width: 100%; display: none;">
                            <embed id="previewPdfLap" src="" type="application/pdf"
                                style="width: 100%; height: 500px; display: none;">
                            <a id="previewWordLinkLap" href="#"
                                style="display: none; color: rgb(0, 140, 255); font-size: 13px" download>Download Word
                                File</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="deleteFileButtonLap" style="display: none;"
                            onclick="deleteFileLap()">Delete</button>
                        <button type="submit" class="btn btn-primary" id="uploadButtonLap" disabled>Upload</button>
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
                        <a id="previewWordLinkLap2" href="#"
                            style="display: none; color: rgb(0, 140, 255); font-size: 13px" download>Download Word
                            File</a>
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
                <form id="uploadFormAnalis" action="{{ url('/history-pengajuan/uploadAnalis') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="pengajuan_idAnalis" id="pengajuan_idAnalis">
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
                        <button type="button" class="btn btn-danger" id="deleteFileButtonAnalis" style="display: none;"
                            onclick="deleteFileAnalis()">Delete</button>
                        <button type="submit" class="btn btn-primary" id="uploadButtonAnalis" disabled>Upload</button>
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
                <form id="uploadForm" action="{{ route('approveBayarAdmin') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="bukti_id" id="bukti_id">
                        <div class="form-group">
                            <label for="berkas">Bukti Pembayaran</label>
                            <embed id="previewPdfApprove" src="" type="application/pdf"
                                style="width: 100%; height: 500px; display: none;">
                            <div id="imagePreviewApprove" style="display: none;">
                                <img id="previewImage" src="">
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
                        <h6 class="mt-1">Riwayat Pengajuan</h6>
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
                            <small class="d-block">Cari Commodity</small>
                            <select class="form-control" name="commodity" id="commodity">
                                <option value="" selected>-- Tampil Semua --</option>
                                @foreach ($commodity as $item)
                                    <option value="{{ $item->keterangan }}">{{ $item->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-2">
                            <small class="d-block">Tanggal Awal</small>
                            <input class="form-control" type="date" id="dateawal" name="dateawal">
                        </div>
                        <div class="col-md-3 col-sm-6 mb-2">
                            <small class="d-block">Tanggal Akhir</small>
                            <input class="form-control" type="date" id="dateakhir" name="dateakhir">
                        </div>
                    </div>
                    <div class="text-start">
                        <a id="export-button" href="{{ route('export-history-pengajuan') }}" class="btn btn-success">
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
                                    <th class="border text-center">Commodity</th>
                                    <th class="border text-center">Date</th>
                                    <th class="border text-center">Consignment Commodity</th>
                                    <th class="border text-center">Identification</th>
                                    <th class="border text-center">Exporting Comp</th>
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
                                        <td class="border">{{ $item->consignment_commodity }}</td>
                                        <td class="border">{{ $item->identification }}</td>
                                        <td class="border">{{ $item->exporting_comp }}</td>
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
                                                        {{-- @if ($item->berkas) --}}
                                                        <form action="{{ route('approve', ['id' => $item->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary mb-0"
                                                                onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approval
                                                                by UPTD??</button>
                                                        </form>
                                                    @elseif ($item->status == 9 && $item->admin_confirm == 0)
                                                        <button
                                                            onclick="openUploadModalApprove({{ $item->id }}, '{{ $item->bukti_pembayaran_pengujian ? asset('storage/' . $item->bukti_pembayaran_pengujian) : '' }}')"
                                                            class="btn btn-primary mb-0">Sudah
                                                            membayar... <br> Selesaikan ?</button>
                                                        {{-- @endif --}}
                                                    @elseif ($item->status == 9 && $item->admin_confirm == 1)
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
                                                        <form action="{{ route('approve', ['id' => $item->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary mb-0"
                                                                onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approve
                                                                test?</button>
                                                        </form>
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
                                                        {{-- @if ($item->berkas) --}}
                                                        <form action="{{ route('approve', ['id' => $item->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary mb-0"
                                                                onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approval
                                                                by UPTD??</button>
                                                        </form>
                                                    @elseif ($item->status == 8 && $item->admin_confirm == 0)
                                                        <button
                                                            onclick="openUploadModalApprove({{ $item->id }}, '{{ $item->bukti_pembayaran_pengujian ? asset('storage/' . $item->bukti_pembayaran_pengujian) : '' }}')"
                                                            class="btn btn-primary mb-0">Sudah
                                                            membayar... <br> Selesaikan ?</button>
                                                    @elseif ($item->status == 8 && $item->admin_confirm == 1)
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
                                                        <form action="{{ route('approve', ['id' => $item->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary mb-0"
                                                                onclick="return confirm('Apakah Anda yakin ingin menyetujui ini?')">Approve
                                                                test?</button>
                                                        </form>
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
                                                        @elseif ($item->type == 2 && $item->status >= 8)
                                                            {{-- DIambil --}}
                                                            <button
                                                                onclick="openUploadModal({{ $item->id }}, '{{ $item->berkas ? asset('storage/' . $item->berkas) : '' }}')"
                                                                class="btn btn-primary btn-sm mt-1 px-3">Upload
                                                                Sertifikat</button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('berkas').addEventListener('change', function() {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2 MB dalam bytes

            if (file && file.size > maxSize) {
                alert('Ukuran maksimal file adalah 2 MB');
                this.value = ''; // Reset input file
                return
            }
        });

        document.getElementById('berkas_analis').addEventListener('change', function() {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2 MB dalam bytes

            if (file && file.size > maxSize) {
                alert('Ukuran maksimal file adalah 2 MB');
                this.value = ''; // Reset input file
                return
            }


        });

        document.getElementById('berkas_laporan').addEventListener('change', function() {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2 MB dalam bytes

            if (file && file.size > maxSize) {
                alert('Ukuran maksimal file adalah 2 MB');
                this.value = ''; // Reset input file
                return
            }
        });

        document.getElementById('berkas').addEventListener('change', function() {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2 MB dalam bytes

            if (file && file.size > maxSize) {
                alert('Ukuran maksimal file adalah 2 MB');
                this.value = ''; // Reset input file
            }
        });

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

            $('#commodity').on('change', function() {
                fetch_data();
            });

            // Handle pagination links
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

        });

        // Fetch data function
        function fetch_data(page = 1) {
            var query = $('#search').val();
            var commodity = $('#commodity').val();
            var dateawal = $('#dateawal').val();
            var dateakhir = $('#dateakhir').val();
            var baseUrl = "{!! url('/history-pengajuan/search') !!}?query=" + query + "&commodity=" + commodity + "&dateawal=" +
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

        function openUploadModal(id, fileUrl) {
            // Reset form dan pratinjau ketika membuka modal
            $('#uploadButton').prop('disabled', true);
            $('#uploadForm').trigger('reset');
            $('#previewPdf').hide(); // Sembunyikan pratinjau PDF terlebih dahulu
            $('#previewWord').hide().attr('src', ''); // Sembunyikan dan kosongkan pratinjau Word
            $('#previewImg').hide().attr('src', ''); // Sembunyikan dan kosongkan pratinjau gambar

            if (fileUrl) {
                var fileExtension = fileUrl.split('.').pop().toLowerCase();

                if (fileExtension === 'pdf') {
                    $('#previewPdf').attr('src', fileUrl).show();
                    $('#deleteFileButton').show();
                } else if (['jpg', 'jpeg', 'png', 'webp'].includes(fileExtension)) {
                    $('#previewImg').attr('src', fileUrl).show();
                    $('#deleteFileButton').show();
                } else {
                    $('#previewWord').attr('src', fileUrl).show();
                    $('#deleteFileButton').show();
                }
            } else {
                $('#deleteFileButton').hide();
            }

            $('#pengajuan_id').val(id);
            $('#uploadModal').modal('show');
        }

        function openCheckModal(id, fileUrl) {
            $('#uploadForm').trigger('reset');
            $('#previewPdf2').hide();
            $('#previewWord2').hide();
            $('#previewImg2').hide();

            // Menentukan jenis file berdasarkan ekstensi
            var fileExtension = fileUrl.split('.').pop().toLowerCase();

            if (fileUrl) {
                if (fileExtension === 'pdf') {
                    $('#previewPdf2').attr('src', fileUrl).show();
                    $('#previewWord2').hide();
                    $('#previewImg2').hide();
                } else if (fileExtension === 'jpg' || fileExtension === 'png' || fileExtension === 'jpeg' ||
                    fileExtension === 'webp') {
                    $('#previewImg2').attr('src', fileUrl).show();
                    $('#previewWord2').hide();
                    $('#previewPdf2').hide();
                } else {
                    $('#previewWord2').attr('src', fileUrl).show();
                    $('#previewPdf2').hide();
                    $('#previewImg2').hide();
                }
            }

            $('#pengajuan_id').val(id);
            $('#checkModal').modal('show');
        }

        $('#uploadModal').on('hidden.bs.modal', function() {
            $('#uploadForm').trigger('reset');
            $('#previewPdf').hide().attr('src', '');
            $('#previewWord').hide().attr('src', ''); // Menyembunyikan dan menghapus sumber pratinjau Word
            $('#previewImg').hide().attr('src', ''); // Menyembunyikan dan menghapus sumber pratinjau gambar
            $('#deleteFileButton').hide(); // Menyembunyikan tombol hapus
        });

        function previewFile(input) {
            var file = input.files[0];
            var fileExtension = file.name.split('.').pop().toLowerCase();
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#previewPdf').hide().attr('src', '');
                $('#previewImg').hide().attr('src', '');

                if (file.type === "application/pdf") {
                    $('#previewPdf').attr('src', e.target.result).show();
                } else if (['jpg', 'jpeg', 'png', 'webp'].includes(fileExtension)) {
                    $('#previewImg').attr('src', e.target.result).show();
                }
            };

            if (file) {
                $('#uploadButton').prop('disabled', false);
                reader.readAsDataURL(file);
            }
        }

        function deleteFile() {
            if (confirm('Are you sure you want to delete this file?')) {
                var id = $('#pengajuan_id').val();
                $.ajax({
                    url: '/history-pengajuan/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('File deleted successfully');
                        // $('#uploadModal').modal('hide');
                        // Hapus pratinjau file dari modal
                        $('#previewPdf').hide().attr('src', '');
                        $('#previewWord').hide().attr('src', '');
                        $('#previewImg').hide().attr('src', '');
                        $('#deleteFileButton').hide();

                        fetch_data();
                        // Optionally, you can refresh the page or update the UI to reflect the deletion
                    },
                    error: function(xhr) {
                        alert('Error deleting file');
                    }
                });
            }
        }

        function openUploadModalLap(id, fileUrl) {
            $('#uploadButtonLap').prop('disabled', true);
            // Reset form dan pratinjau ketika membuka modal
            $('#uploadFormLap').trigger('reset');
            $('#previewPdfLap').hide(); // Sembunyikan pratinjau PDF terlebih dahulu
            $('#previewWordLinkLap').hide().attr('src', '');
            $('#previewImgLap').hide().attr('src', ''); // Sembunyikan dan kosongkan pratinjau gambar

            if (fileUrl) {
                var fileExtension = fileUrl.split('.').pop().toLowerCase();

                if (fileExtension === 'pdf') {
                    $('#previewPdfLap').attr('src', fileUrl).show();
                    $('#deleteFileButtonLap').show();
                } else if (['jpg', 'jpeg', 'png', 'webp'].includes(fileExtension)) {
                    $('#previewImgLap').attr('src', fileUrl).show();
                    $('#deleteFileButtonLap').show();
                } else {
                    $('#previewWordLinkLap').attr('href', fileUrl).text("Download Berkas").show();
                    $('#deleteFileButtonLap').show();
                }
            } else {
                $('#deleteFileButtonLap').hide();
            }

            $('#pengajuan_idLap').val(id);
            $('#uploadModalLap').modal('show');
        }

        function openCheckModalLap(id, fileUrl) {
            $('#uploadFormLap').trigger('reset');
            $('#previewPdfLap2').hide();
            $('#previewWordLinkLap2').hide();
            $('#previewImgLap2').hide();

            // Menentukan jenis file berdasarkan ekstensi
            var fileExtension = fileUrl.split('.').pop().toLowerCase();

            if (fileUrl) {
                if (fileExtension === 'pdf') {
                    $('#previewPdfLap2').attr('src', fileUrl).show();
                    $('#previewWordLinkLap2').hide();
                    $('#previewImgLap2').hide();
                } else if (fileExtension === 'jpg' || fileExtension === 'png' || fileExtension === 'jpeg' ||
                    fileExtension === 'webp') {
                    $('#previewImgLap2').attr('src', fileUrl).show();
                    $('#previewWordLinkLap2').hide();
                    $('#previewPdfLap2').hide();
                } else {
                    $('#previewWordLinkLap2').attr('href', fileUrl).text("Download").show();
                    $('#previewPdfLap2').hide();
                    $('#previewImgLap2').hide();
                }
            }

            $('#pengajuan_idLap').val(id);
            $('#checkModalLap').modal('show');
        }

        $('#uploadModalLap').on('hidden.bs.modal', function() {
            $('#uploadFormLap').trigger('reset');
            $('#previewPdfLap').hide().attr('src', '');
            $('#previewWordLinkLap').hide().attr('src', '');
            $('#previewImgLap').hide().attr('src', ''); // Menyembunyikan dan menghapus sumber pratinjau gambar
            $('#deleteFileButtonLap').hide(); // Menyembunyikan tombol hapus
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
                } else {
                    $('#previewWordLinkLap').attr('href', fileUrl).text("Download Berkas")
                        .show(); // Tampilkan nama file sebagai tautan
                    $('#deleteFileButtonLap').show();
                }
            };

            if (file) {
                $('#uploadButtonLap').prop('disabled', false);
                reader.readAsDataURL(file);
            }
        }

        function deleteFileLap() {
            if (confirm('Are you sure you want to delete this file?')) {
                var id = $('#pengajuan_idLap').val();
                $.ajax({
                    url: '/history-pengajuan/deleteLaporan/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('File deleted successfully');
                        // $('#uploadModalLap').modal('hide');
                        // Hapus pratinjau file dari modal
                        $('#previewPdfLap').hide().attr('src', '');
                        $('#previewWordLap').hide().attr('src', '');
                        $('#previewImgLap').hide().attr('src', '');
                        $('#deleteFileButtonLap').hide();

                        fetch_data();
                        // Optionally, you can refresh the page or update the UI to reflect the deletion
                    },
                    error: function(xhr) {
                        alert('Error deleting file');
                    }
                });
            }
        }

        function openUploadModalAnalis(id, fileUrl) {
            $('#uploadButtonAnalis').prop('disabled', true);
            // Reset form dan pratinjau ketika membuka modal
            $('#uploadFormAnalis').trigger('reset');
            $('#previewPdfAnalis').hide().attr('src', ''); // Sembunyikan dan kosongkan pratinjau PDF
            $('#previewWordLinkAnalis').hide().attr('src', ''); // Sembunyikan dan kosongkan pratinjau Word
            $('#previewImgAnalis').hide().attr('src', ''); // Sembunyikan dan kosongkan pratinjau gambar

            if (fileUrl) {
                var fileExtension = fileUrl.split('.').pop().toLowerCase();

                if (fileExtension === 'pdf') {
                    $('#previewPdfAnalis').attr('src', fileUrl).show();
                    $('#deleteFileButtonAnalis').show();
                } else if (['jpg', 'jpeg', 'png', 'webp'].includes(fileExtension)) {
                    $('#previewImgAnalis').attr('src', fileUrl).show();
                    $('#deleteFileButtonAnalis').show();
                } else {
                    $('#previewWordLinkAnalis').attr('href', fileUrl).text("Download Berkas").show(); // Tampilkan nama file sebagai tautan
                    $('#deleteFileButtonAnalis').show();
                }
            } else {
                $('#deleteFileButtonAnalis').hide();
            }

            $('#pengajuan_idAnalis').val(id);
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

            $('#pengajuan_idAnalis').val(id);
            $('#checkModalAnalis').modal('show');
        }

        $('#uploadModalAnalis').on('hidden.bs.modal', function() {
            $('#uploadFormAnalis').trigger('reset');
            $('#previewPdfAnalis').hide().attr('src', ''); // Menyembunyikan dan menghapus sumber pratinjau PDF
            $('#previewWordLinkAnalis').hide().attr('src', '');
            $('#previewImgAnalis').hide().attr('src', ''); // Menyembunyikan dan menghapus sumber pratinjau gambar
            $('#deleteFileButtonAnalis').hide(); // Menyembunyikan tombol hapus
        });

        function previewFileAnalis(input) {
            var file = input.files[0];
            var fileExtension = file.name.split('.').pop().toLowerCase();
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#previewPdfAnalis').hide().attr('src', '');
                $('#previewImgAnalis').hide().attr('src', '');

                if (file.type === "application/pdf") {
                    $('#previewPdfAnalis').attr('src', e.target.result).show();
                } else if (['jpg', 'jpeg', 'png', 'webp'].includes(fileExtension)) {
                    $('#previewImgAnalis').attr('src', e.target.result).show();
                }
            };

            if (file) {
                $('#uploadButtonAnalis').prop('disabled', false);
                reader.readAsDataURL(file);
            }
        }

        function deleteFileAnalis() {
            if (confirm('Are you sure you want to delete this file?')) {
                var id = $('#pengajuan_idAnalis').val();
                $.ajax({
                    url: '/history-pengajuan/deleteAnalis/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('File deleted successfully');
                        // $('#uploadModalAnalis').modal('hide');
                        // Hapus pratinjau file dari modal
                        $('#previewPdfAnalis').hide().attr('src', '');
                        $('#previewWordLinkAnalis').hide().attr('src', '');
                        $('#previewImgAnalis').hide().attr('src', '');
                        $('#deleteFileButtonAnalis').hide();

                        fetch_data();
                        // Optionally, you can refresh the page or update the UI to reflect the deletion
                    },
                    error: function(xhr) {
                        alert('Error deleting file');
                    }
                });
            }
        }
    </script>

    <script>
        document.getElementById('export-button').addEventListener('click', function() {
            var search = document.getElementById('search').value;
            var commodity = document.getElementById('commodity').value;
            var dateawal = document.getElementById('dateawal').value;
            var dateakhir = document.getElementById('dateakhir').value;
            var exportUrl = this.getAttribute('href') + '?searchh=' + search + "&commodity=" + commodity +
                "&dateawal=" + dateawal + "&dateakhir=" + dateakhir;
            this.setAttribute('href', exportUrl);
        });
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
