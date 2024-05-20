@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Data Logo'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action={{ route('data-logo.create') }} enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Logo</p>
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
                                        <label for="example-text-input" class="form-control-label">Logo</label>
                                        <input type="file" class="form-control" id="foto" name="foto"
                                            onchange="previewFoto(this)">
                                        <img id="preview" src="#" alt="Foto"
                                            style="display: none; max-width: 200px; max-height: 200px;">

                                        @error('foto')
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

    <script>
        function previewFoto(input) {
            var preview = document.getElementById('preview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>

<script>
    window.onload = function() {
        var preview = document.getElementById('preview');
        var fotoUrl = "{{ isset($logo) ? asset('storage/' . $logo->foto) : '#' }}";

        if (fotoUrl !== '#') {
            preview.src = fotoUrl;
            preview.style.display = 'block';
        }
    }
</script>

@endsection
