@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit History Pengajuan'])

    <div class="row mt-0 mx-1">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit History Pengajuan</h6>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form action="{{ route('history-pengajuan.update', $history->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            @if ($rolename->name == 'TU')
                                <div class="col-md-6 mb-3">
                                    <label for="keterangan" class="form-label">Biaya Layanan</label>
                                    <input type="file" class="form-control" id="file" name="file"
                                        onchange="previewFile(this)">
                                        <div id="preview-container" style="display: none;">
                                            <img id="preview-image" src="#" alt="Preview" style="max-width: 200px; max-height: 200px; display: none;">
                                            <embed id="preview-pdf" src="#" type="application/pdf" width="60%" height="600" style="display: none;">
                                        </div>

                                    @error('biaya')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-md-12 mb-3">
                                <label for="file_pengajuan" class="form-label">File Pengajuan</label>
                                <br>
                                @if ($history->file_pengajuan)
                                    @if (pathinfo($history->file_pengajuan, PATHINFO_EXTENSION) == 'pdf')
                                        <embed src="{{ asset('storage/' . $history->file_pengajuan) }}"
                                            type="application/pdf" width="50%" height="600px" />
                                    @else
                                        <img src="{{ asset('storage/' . $history->file_pengajuan) }}" alt="File Pengajuan"
                                            style="max-width: 50%; height: auto;">
                                    @endif
                                @else
                                    <p>No file attached.</p>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="kode" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $history->name }}">
                            </div>

                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    value="{{ $history->date }}">
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Sealing Mark</label>
                                <input type="text" class="form-control" id="sealing_mark" name="sealing_mark"
                                    value="{{ $history->sealing_mark }}">
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Report Of Sampling Taken from</label>
                                <input type="text" class="form-control" id="report_sealing" name="report_sealing"
                                    value="{{ $history->report_sealing }}">
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Consignment Commodity</label>
                                <input type="text" class="form-control" id="consignment_commodity"
                                    name="consignment_commodity" value="{{ $history->consignment_commodity }}">
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Identification of consignment / Shipping
                                    mark</label>
                                <input type="text" class="form-control" id="identification" name="identification"
                                    value="{{ $history->identification }}">
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Exporting Comp</label>
                                <input type="text" class="form-control" id="exporting_comp" name=" exporting_comp"
                                    value="{{ $history->exporting_comp }}">
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Addres</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $history->address }}">
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Application
                                    Number ( Nomor Surat Permohonan )</label>
                                <input type="text" class="form-control" id="regist_number" name="regist_number"
                                    value="{{ $history->regist_number }}">
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Type Packing</label>
                                <input type="text" class="form-control" id="type_packing" name="type_packing"
                                    value="{{ $history->type_packing }}">
                            </div>
                            <div class="col-md-4">
                                <label for="keterangan" class="form-label">Quantity of
                                    Packages</label>
                                <input type="text" class="form-control" id="qty_packag" name="qty_package"
                                    value="{{ $history->qty_package }}">
                            </div>
                            <div class="col-md-4">
                                <label for="keterangan" class="form-label">Weight (Gross / Kgs)</label>
                                <input type="text" class="form-control" id="weight" name="weight"
                                    value="{{ $history->weight }}">
                            </div>
                            <div class="col-md-4">
                                <label for="keterangan" class="form-label">Volume (Nett / Kgs)</label>
                                <input type="text" class="form-control" id="volume" name="volume"
                                    value="{{ $history->volume }}">
                            </div>
                        </div>

                            {{-- Form input array --}}
                            <div class="col-md-12 mt-3">
                                <label for="detail_tambahan" class="form-label">Detail Tambahan</label>
                                <div class="row">
                                    <div class="col-md-5 text-center">
                                        Judul
                                    </div>
                                    <div class="col-md-5 text-center">
                                        Isi
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                                <div id="detail_inputs">
                                    @if ($history->detail_tambahan)
                                        @foreach (json_decode($history->detail_tambahan) as $index => $detail_tambahan)
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control"
                                                        name="detail_tambahan[{{ $index }}][judul_form]"
                                                        value="{{ $detail_tambahan->judul_form }}" placeholder="Judul">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control"
                                                        name="detail_tambahan[{{ $index }}][isi_form]"
                                                        value="{{ $detail_tambahan->isi_form }}" placeholder="Isi">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="removeDetailInput(this)">Remove</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="detail_tambahan[0][judul_form]"
                                                    placeholder="Judul">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="detail_tambahan[0][isi_form]"
                                                    placeholder="Isi">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeDetailInput(this)">Remove</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-success mt-2" onclick="addDetailInput()">Add
                                    Form</button>
                            </div>
                            {{-- End Form input array --}}


                        <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFile(input) {
            var previewContainer = document.getElementById('preview-container');
            var previewImage = document.getElementById('preview-image');
            var previewPdf = document.getElementById('preview-pdf');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                if (file.type === "application/pdf") {
                    previewPdf.src = reader.result;
                    previewPdf.style.display = 'block';
                    previewImage.style.display = 'none';
                } else {
                    previewImage.src = reader.result;
                    previewImage.style.display = 'block';
                    previewPdf.style.display = 'none';
                }
                previewContainer.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
                previewImage.style.display = 'none';
                previewPdf.style.display = 'none';
            }
        }

        window.onload = function() {
            var previewContainer = document.getElementById('preview-container');
            var previewImage = document.getElementById('preview-image');
            var previewPdf = document.getElementById('preview-pdf');
            var fotoUrl = "{{ isset($history) ? asset('storage/' . $history->biaya) : '#' }}";

            if (fotoUrl !== '#') {
                if (fotoUrl.endsWith('.pdf')) {
                    previewPdf.src = fotoUrl;
                    previewPdf.style.display = 'block';
                    previewImage.style.display = 'none';
                } else {
                    previewImage.src = fotoUrl;
                    previewImage.style.display = 'block';
                    previewPdf.style.display = 'none';
                }
                previewContainer.style.display = 'block';
            }
        }

         // Function to add detail_tambahan input field
         function addDetailInput() {
            let index = document.querySelectorAll('#detail_inputs .row').length;
            let detailInput = `
            <div class="row">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="detail_tambahan[${index}][judul_form]" placeholder="Judul">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="detail_tambahan[${index}][isi_form]" placeholder="Isi">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger" onclick="removeDetailInput(this)">Remove</button>
                </div>
            </div>
        `;
            document.getElementById('detail_inputs').insertAdjacentHTML('beforeend', detailInput);
        }

        // Function to remove detail_tambahan input field
        function removeDetailInput(button) {
            button.closest('.row').remove();
        }
    </script>
@endsection
