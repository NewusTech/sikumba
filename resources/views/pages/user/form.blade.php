@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Layanan Form Pengujian'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action={{ route('form.create') }} enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0">Form Pengujian</h5>
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
                                <input type="file" class="form-control" id="file" name="file"
                                    accept=".pdf, .jpg, .jpeg, .png">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Identification of
                                            consignment / Shipping mark</label>
                                        <input class="form-control" type="text" name="identification"
                                            value="{{ auth()->check() ? auth()->user()->identification : '' }}">
                                        @error('identification')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Exporting Company</label>
                                        <input class="form-control" type="text" name="company"
                                            value="{{ auth()->check() ? auth()->user()->company : '' }}">
                                        @error('company')
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
                                        <label for="example-text-input" class="form-control-label">Application
                                            Number ( Nomor Surat Permohonan )</label>
                                        <input class="form-control" type="text" name="regisnumber"
                                            value="{{ auth()->check() ? auth()->user()->regisnumber : '' }}">
                                        @error('regisnumber')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Type of
                                            Commodity</label>
                                        <select class="form-control" name="typecommodity">
                                            @foreach ($commodity as $item)
                                                <option value="{{ $item->keterangan }}">{{ $item->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Type of Packing</label>
                                        <input class="form-control" type="text" name="packin"
                                            value="{{ auth()->check() ? auth()->user()->packin : '' }}">
                                        @error('packin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type" class="form-control-label">Type of Service ( Jenis Pelayanan
                                            )</label>
                                        <select class="form-control" name="type">
                                            <option value="1"
                                                {{ auth()->check() && auth()->user()->type == '1' ? 'selected' : '' }}>
                                                Sample diantar</option>
                                            <option value="2"
                                                {{ auth()->check() && auth()->user()->type == '2' ? 'selected' : '' }}>
                                                Sample diambil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Quantity of
                                            Packages</label>
                                        <input class="form-control" type="text" name="quantity"
                                            value="{{ auth()->check() ? auth()->user()->quantity : '' }}">
                                        @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Weight (Gross / Kgs)
                                        </label>
                                        <input class="form-control" type="text" name="weight"
                                            value="{{ auth()->check() ? auth()->user()->weight : '' }}">
                                        @error('weight')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Volume (Nett / Kgs)
                                        </label>
                                        <input class="form-control" type="text" name="volume"
                                            value="{{ auth()->check() ? auth()->user()->volume : '' }}">
                                        @error('volume')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary">Unggah</button> --}}
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
