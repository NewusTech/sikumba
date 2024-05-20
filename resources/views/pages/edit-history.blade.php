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
                <form action="{{ route('history-pengajuan.update', $history->id) }}" method="post">
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
                            <input type="text" class="form-control" id="name" name="name" value="{{ $history->name }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="keterangan" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $history->date }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="keterangan" class="form-label">Sealing Mark</label>
                            <input type="text" class="form-control" id="sealing_mark" name="sealing_mark" value="{{ $history->sealing_mark}}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="keterangan" class="form-label">Report Sealing</label>
                            <input type="text" class="form-control" id="report_sealing" name="report_sealing" value="{{ $history->report_sealing }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="keterangan" class="form-label">Consignment Commodity</label>
                            <input type="text" class="form-control" id="consignment_commodity" name="consignment_commodity" value="{{ $history->consignment_commodity }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="keterangan" class="form-label">Identification of consignment / Shipping mark</label>
                            <input type="text" class="form-control" id="identification" name="identification" value="{{ $history->identification }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Exporting Comp</label>
                            <input type="text" class="form-control" id="exporting_comp" name=" exporting_comp" value="{{ $history->exporting_comp }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Addres</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $history->address}}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="keterangan" class="form-label">Application
                                Number ( Nomor Surat Permohonan )</label>
                            <input type="text" class="form-control" id="regist_number" name="regist_number" value="{{ $history->regist_number }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="keterangan" class="form-label">Type Packing</label>
                            <input type="text" class="form-control" id="type_packing" name="type_packing" value="{{ $history->type_packing}}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="keterangan" class="form-label">Quantity of
                                Packages</label>
                            <input type="text" class="form-control" id="qty_packag" name="qty_package" value="{{ $history->qty_package }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="keterangan" class="form-label">Weight (Gross / Kgs)</label>
                            <input type="text" class="form-control" id="weight" name="weight" value="{{ $history->weight}}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="keterangan" class="form-label">Volume (Nett / Kgs)</label>
                            <input type="text" class="form-control" id="volume" name="volume" value="{{ $history->volume }}" required>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
