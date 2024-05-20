@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 m-3">
                <div class="card">
                    <div class="card-header">Survey Kepuasan Pelanggan</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" id="successAlert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('form-survey.submit') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required
                                        autofocus>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email (Optional)</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email">
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label for="handhphone" class="col-md-4 col-form-label text-md-right">No. Handphone</label>

                                <div class="col-md-6">
                                    <input id="handphpne" type="text" class="form-control" name="no_handphone" required>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>

                                <div class="col-md-6">
                                    <input id="alamat" type="text" class="form-control" name="alamat" required>
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label for="rating" class="col-md-4 col-form-label text-md-right">Penilaian</label>

                                <div class="col-md-6">
                                    <select id="rating" class="form-control" name="rating" required>
                                        <option value="">Pilih Penilaian</option>
                                        <option value="sangat_memuaskan">Sangat Memuaskan</option>
                                        <option value="memuaskan">Memuaskan</option>
                                        <option value="cukup_memuaskan">Cukup Memuaskan</option>
                                        <option value="buruk">Buruk</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comments" class="col-md-4 col-form-label text-md-right">Komentar
                                    (Opsional)</label>

                                <div class="col-md-6">
                                    <textarea id="comments" class="form-control" name="comments" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Kirim Survey
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        // Set timeout untuk menghilangkan alert setelah 5 detik
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 5000);
    </script> --}}
@endsection
