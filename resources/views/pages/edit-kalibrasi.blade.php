@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Data Kalibrasi'])

    <div class="row mt-0 mx-1">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Data Kalibrasi</h6>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form action="{{ route('history-kalibrasi.update', $history->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                <label for="file_pengajuan" class="form-label">File Pengajuan</label>
                                <br>
                                @if($history->file_pengajuan)
                                    @if(pathinfo($history->file_pengajuan, PATHINFO_EXTENSION) == 'pdf')
                                        <embed src="{{ asset('storage/' . $history->file_pengajuan) }}" type="application/pdf" width="50%" height="600px" />
                                    @else
                                        <img src="{{ asset('storage/' . $history->file_pengajuan) }}" alt="File Pengajuan" style="max-width: 50%; height: auto;">
                                    @endif
                                @else
                                    <p>No file attached.</p>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                <label for="kode" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $history->name }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Application Date</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    value="{{ $history->date }}" required min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Addres</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $history->address }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="form-control-label">Nama Alat</label>
                                <input type="text" class="form-control" id="nama_alat" name="nama_alat"
                                    value="{{ $history->nama_alat }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="form-control-label">Merek Alat</label>
                                <input type="text" class="form-control" id="merek_alat" name="merek_alat"
                                    value="{{ $history->merek_alat }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="form-control-label">Serial Number Alat</label>
                                <input type="text" class="form-control" id="serial_number_alat" name="serial_number_alat"
                                    value="{{ $history->serial_number_alat }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="form-control-label">Kapasitas</label>
                                <input type="text" class="form-control" id="kapasitas" name="kapasitas"
                                    value="{{ $history->kapasitas }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="form-control-label">Area Kalibrasi</label>
                                <input type="text" class="form-control" id="area_kalibrasi" name="area_kalibrasi"
                                    value="{{ $history->area_kalibrasi }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
