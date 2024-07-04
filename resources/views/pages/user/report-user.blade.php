@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Riwayat'])

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#surveyModal">
        Open Survey Modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="surveyModal" tabindex="-1" role="dialog" aria-labelledby="surveyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="surveyModalLabel">Survey Kepuasan Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session('success'))
                        <div class="alert alert-success" id="successAlert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('form-survey.submit') }}">
                        @csrf

                        <input type="hidden" name="pengajuan_id" id="pengajuan_id">

                        <!-- Nama -->
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input id="name" type="text" class="form-control" name="name" required autofocus>
                        </div>

                        <!-- Email -->
                        {{-- <div class="form-group">
                            <label for="email">Email (Optional)</label>
                            <input id="email" type="email" class="form-control" name="email">
                        </div> --}}

                        <!-- No. Handphone -->
                        <div class="form-group">
                            <label for="handphone">No. Handphone</label>
                            <input id="handphone" type="text" class="form-control" name="no_handphone" required>
                        </div>

                        <!-- Alamat -->
                        {{-- <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input id="alamat" type="text" class="form-control" name="alamat" required>
                        </div> --}}

                        <!-- Penilaian -->
                        <div class="form-group">
                            <label for="rating">Penilaian</label>
                            <select id="rating" class="form-control" name="rating" required>
                                <option value="">Pilih Penilaian</option>
                                <option value="sangat_memuaskan">Sangat Memuaskan</option>
                                <option value="memuaskan">Memuaskan</option>
                                <option value="cukup_memuaskan">Cukup Memuaskan</option>
                                <option value="buruk">Buruk</option>
                            </select>
                        </div>

                        <!-- Komentar -->
                        <div class="form-group">
                            <label for="comments">Komentar (Opsional)</label>
                            <textarea id="comments" class="form-control" name="comments" rows="5"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Kirim Survey</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- File Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadForm" action="{{ route('approveBayar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="bukti_id" id="bukti_id">
                        <div class="form-group">
                            <label for="berkas">Choose</label>
                            <input type="file" class="form-control" id="berkas" name="berkas"
                                onchange="previewFile(this);">

                            <embed id="previewPdf" src="" type="application/pdf"
                                style="width: 100%; height: 500px; display: none;">
                            <div id="imagePreview" style="display: none;">
                                <img id="previewImage" src="" style="max-width: 100%; height: auto;">
                            </div>
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
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3" id="search-list">
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
                                                @elseif ($item->status == 0 && $item->status == 1)
                                                    <span>Sedang diproses</span>
                                                @elseif ($item->status == 2)
                                                    <span>Pengambilan contoh</span>
                                                @elseif ($item->status >= 3 && $item->status <= 7)
                                                    <span>Sedang pengujian</span>
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
                                                @elseif ($item->status == 0 && $item->status == 1)
                                                    <span>Sedang diproses</span>
                                                @elseif ($item->status == 2)
                                                    <span>Pengambilan contoh</span>
                                                @elseif ($item->status >= 3 && $item->status <= 8)
                                                    <span>Sedang pengujian</span>
                                                @else
                                                    <span>Sedang diproses</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center text-nowrap border">
                                            @if ($item->type == 1)
                                                @if ($item->status == 8 && $item->admin_confirm == 1)
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
                                                @elseif ($item->status == 0 && $item->status == 1)
                                                    <span>Sedang diproses</span>
                                                @elseif ($item->status == 2)
                                                    <span>Pengambilan contoh</span>
                                                @elseif ($item->status >= 3 && $item->status <= 7)
                                                    <span>Sedang pengujian</span>
                                                @else
                                                    <span>Sedang diproses</span>
                                                @endif
                                            @elseif ($item->type == 2)
                                                @if ($item->status == 9 && $item->admin_confirm == 1)
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
                                                @elseif ($item->status == 0 && $item->status == 1)
                                                    <span>Sedang diproses</span>
                                                @elseif ($item->status == 2)
                                                    <span>Pengambilan contoh</span>
                                                @elseif ($item->status >= 3 && $item->status <= 8)
                                                    <span>Sedang pengujian</span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle live search
            $('#search').on('keyup', function() {
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
                var baseUrl = "{!! url('/report-user/search') !!}?query=" + query;
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
        // Set the value of the hidden input field when the modal is opened
        $('#surveyModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var pengajuanId = button.data('id'); // Extract info from data-* attributes
            $('#pengajuan_id').val(pengajuanId); // Set the value of the hidden input field
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

            $('#bukti_id').val(id);
            $('#uploadModal').modal('show');
        }

        function openCheckModal(id, pdfUrl) {
            $('#uploadForm').trigger('reset');
            $('#previewPdf2').hide();
            if (pdfUrl) {
                $('#previewPdf2').attr('src', pdfUrl).show();
            }

            $('#bukti_id').val(id);
            $('#checkModal').modal('show');
        }

        $('#uploadModal').on('hidden.bs.modal', function() {
            $('#uploadForm').trigger('reset');
            $('#previewPdf').hide().attr('src', ''); // Menyembunyikan dan menghapus sumber pratinjau PDF
        });


        function previewFile(input) {
            var file = input.files[0];
            var previewPdf = document.getElementById('previewPdf');
            var previewImage = document.getElementById('previewImage');
            var imagePreview = document.getElementById('imagePreview');

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    if (file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/png') {
                        // Tampilkan pratinjau jika file adalah gambar JPG
                        previewPdf.style.display = 'none';
                        previewImage.src = e.target.result;
                        imagePreview.style.display = 'block';
                    } else if (file.type === 'application/pdf') {
                        // Tampilkan pratinjau jika file adalah PDF
                        previewImage.src = '';
                        imagePreview.style.display = 'none';
                        previewPdf.src = e.target.result;
                        previewPdf.style.display = 'block';
                    } else {
                        // Sembunyikan pratinjau jika bukan gambar JPG atau PDF
                        previewImage.src = '';
                        imagePreview.style.display = 'none';
                        previewPdf.src = '';
                        previewPdf.style.display = 'none';
                        // Tampilkan pesan bahwa file tidak didukung
                        alert('Unsupported file format. Please select a JPG image or PDF file.');
                    }
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
