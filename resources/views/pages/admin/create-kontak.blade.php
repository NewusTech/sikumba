@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Kontak Kami'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action={{ route('kontak.create') }}
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Kontak Kami</p>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">No Telephone</label>
                                        {{-- <input class="form-control" type="text" name="kepala_dinas" value="{{ old('$sertification->kepala_dinas', auth()->check() ? auth()->user()->kepala_dinas : '' )}}"> --}}
                                        <input class="form-control" type="text" name="no_telephone"
                                            value="{{ isset($kontak->no_telephone) ? $kontak->no_telephone : '' }}">
                                        @error('no_telephone')
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
