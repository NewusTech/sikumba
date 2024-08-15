@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Form Kalibrasi'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action={{ route('formkalibrasi.create') }}
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0">Form Kalibrasi</h5>
                                @if (Session::has('success'))
                                    <div class="alert alert-success" id="successAlert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <small>Upload Surat Permohonan</small>
                            <div class="form-group">
                                <label for="file" class="custom-file-label">Pilih Berkas (PDF / Foto)</label>
                                <small style="margin-left: 2px; font-size: 11px">maks 2 MB</small>
                                <input type="file" class="form-control" id="file" name="file" accept=".pdf, .jpg, .jpeg, .png">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name <small
                                                class="text-danger">*</small></label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ auth()->check() ? auth()->user()->name : '' }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Application date <small
                                                class="text-danger">*</small></label>
                                        <input class="form-control" type="date" name="date"
                                            value="{{ auth()->user()->date ? auth()->user()->date->format('Y-m-d') : '' }}"
                                            min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Address</label>
                                        <input class="form-control" type="text" name="address"
                                            value="{{ auth()->check() ? auth()->user()->address : '' }}">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama Alat</label>
                                        <input class="form-control" type="text" name="nama_alat"
                                            value="{{ auth()->check() ? auth()->user()->nama_alat : '' }}">
                                        @error('nama_alat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Merek Alat</label>
                                        <input class="form-control" type="text" name="merek_alat"
                                            value="{{ auth()->check() ? auth()->user()->merek_alat : '' }}">
                                        @error('merek_alat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Serial Number
                                            Alat</label>
                                        <input class="form-control" type="text" name="serial_number_alat"
                                            value="{{ auth()->check() ? auth()->user()->serial_number_alat : '' }}">
                                        @error('serial_number_alat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kapasitas</label>
                                        <input class="form-control" type="text" name="kapasitas"
                                            value="{{ auth()->check() ? auth()->user()->kapasitas : '' }}">
                                        @error('kapasitas')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Area Kalibrasi</label>
                                        <input class="form-control" type="text" name="area_kalibrasi"
                                            value="{{ auth()->check() ? auth()->user()->area_kalibrasi : '' }}">
                                        @error('area_kalibrasi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Set timeout untuk menghilangkan alert setelah 5 detik
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000);

        document.getElementById('file').addEventListener('change', function() {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2 MB dalam bytes

            if (file && file.size > maxSize) {
                alert('Ukuran maksimal file adalah 2 MB');
                this.value = ''; // Reset input file
            }
        });
    </script>
@endsection
