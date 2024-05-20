@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Data Sertification'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action={{ route('data-sertifikat.create') }}
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Sertification</p>
                                @if (Session::has('success'))
                                    <div class="alert alert-success" id="successAlert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kepala Dinas</label>
                                        {{-- <input class="form-control" type="text" name="kepala_dinas" value="{{ old('$sertification->kepala_dinas', auth()->check() ? auth()->user()->kepala_dinas : '' )}}"> --}}
                                        <input class="form-control" type="text" name="kepala_dinas"
                                            value="{{ isset($sertification->kepala_dinas) ? $sertification->kepala_dinas : '' }}">
                                        @error('kepala_dinas')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">NIP</label>
                                        <input class="form-control" type="text" name="nip"
                                            value="{{ isset($sertification->nip) ? $sertification->nip : '' }}">
                                        @error('nip')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kepala BPSMB</label>
                                        <input class="form-control" type="text" name="kepala_bpsmb"
                                            value="{{ isset($sertification->kepala_bpsmb) ? $sertification->kepala_bpsmb : '' }}">
                                        @error('kepala_bpsmb')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">NIP</label>
                                        <input class="form-control" type="text" name="nip_bpsmb"
                                            value="{{ isset($sertification->nip_bpsmb) ? $sertification->nip_bpsmb : '' }}">
                                        @error('nip_bpsmb')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Technical Manager</label>
                                        <input class="form-control" type="text" name="technical_manager"
                                            value="{{ isset($sertification->technical_manager) ? $sertification->technical_manager : '' }}">
                                        @error('technical_manager')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">NIP</label>
                                        <input class="form-control" type="text" name="nip_manager"
                                            value="{{ isset($sertification->nip_manager) ? $sertification->nip_manager : '' }}">
                                        @error('nip_manager')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">NO. Laboratory </label>
                                        <input class="form-control" type="text" name="no_lab"
                                            value="{{ isset($sertification->no_lab) ? $sertification->no_lab : '' }}">
                                        @error('no_lab')
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
    </script>
@endsection
