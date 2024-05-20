@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Sertifikat'])

    <div class="row mt-0 mx-1">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Laporan Hasil Analisa (Report of Analys)</h6>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form action="{{ route('history-pengajuan.updatelaporan', $history->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <label for="no_laporan" class="form-label">Nomor Sertifikat</label>
                                <input type="text" class="form-control" id="no_laporan" name="no_laporan"
                                    value="{{ $history->no_laporan }}">
                            </div>

                            <div class="col-md-6">
                                <label for="commodity_surat" class="form-label">Commodity</label>
                                <input type="text" class="form-control" id="commodity_surat" name="commodity_surat"
                                    value="{{ $history->commodity_surat }}">
                            </div>

                            <div class="col-md-6">
                                <label for="sample_desc_surat" class="form-label">Sample Description</label>
                                <input type="text" class="form-control" id="sample_desc_surat" name="sample_desc_surat"
                                    value="{{ $history->sample_desc_surat }}">
                            </div>

                            <div class="col-md-6">
                                <label for="received_surat" class="form-label">Date of Received</label>
                                <input type="date" class="form-control" id="received_surat" name="received_surat"
                                    value="{{ $history->received_surat ?? now()->format('Y-m-d') }}">
                            </div>

                            <div class="col-md-6">
                                <label for="analisdate_surat" class="form-label">Date of Analys</label>
                                <input type="date" class="form-control" id="analisdate_surat" name="analisdate_surat"
                                    value="{{ $history->analisdate_surat ?? now()->format('Y-m-d') }}">
                            </div>

                            <div class="col-md-6">
                                <label for="note_laporan" class="form-label">Note / Valid time</label>
                                <input type="text" class="form-control" id="note_laporan" name="note_laporan"
                                    value="{{ $history->note_laporan }}">
                            </div>

                            {{-- Form input array --}}
                            <div class="col-md-12 mt-3">
                                <label for="detail_laporan" class="form-label">Detail</label>
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        Code
                                    </div>
                                    <div class="col-md-2 text-center">
                                        Characteristic
                                    </div>
                                    <div class="col-md-2 text-center">
                                        Unit
                                    </div>
                                    <div class="col-md-2 text-center">
                                        Test Result
                                    </div>
                                    <div class="col-md-2 text-center">
                                        Test Method
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                                <div id="detail_inputs">
                                    @if ($history->detail_laporan)
                                        @foreach (json_decode($history->detail_laporan) as $index => $detail_laporan)
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control"
                                                        name="detail_laporan[{{ $index }}][code]"
                                                        value="{{ $detail_laporan->code }}" placeholder="Code">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control"
                                                        name="detail_laporan[{{ $index }}][characteristic]"
                                                        value="{{ $detail_laporan->characteristic }}" placeholder="Characteristic">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="detail_laporan[{{ $index }}][unit]" value="{{ $detail_laporan->unit }}"
                                                        placeholder="Unit">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="detail_laporan[{{ $index }}][test]" value="{{ $detail_laporan->test }}"
                                                        placeholder="Test Result">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control"
                                                        name="detail_laporan[{{ $index }}][method]"
                                                        value="{{ $detail_laporan->method }}" placeholder="Method">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="removeDetailInput(this)">Remove</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="detail_laporan[0][code]"
                                                    placeholder="Code">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="detail_laporan[0][characteristic]"
                                                    placeholder="Characteristic">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="detail_laporan[0][unit]"
                                                    placeholder="Unit">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="detail_laporan[0][test]"
                                                    placeholder="Test Result">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="detail_laporan[0][method]"
                                                    placeholder="Method">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeDetailInput(this)">Remove</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-success mt-2" onclick="addDetailInput()">Add
                                    Detail</button>
                            </div>
                            {{-- End Form input array --}}
                        </div>

                        {{-- tambahkan satu input teks --}}
                </div>

                <button type="submit" class="btn btn-primary mt-4 w-25">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        // Function to add detail_laporan input field
        function addDetailInput() {
            let index = document.querySelectorAll('#detail_inputs .row').length;
            let detailInput = `
            <div class="row">
                <div class="col-md-2">
                    <input type="text" class="form-control" name="detail_laporan[${index}][code]" placeholder="Code">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="detail_laporan[${index}][characteristic]" placeholder="Characteristic">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="detail_laporan[${index}][unit]" placeholder="Unit">
                </div>  
                <div class="col-md-2">
                    <input type="text" class="form-control" name="detail_laporan[${index}][test]" placeholder="Test Result">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="detail_laporan[${index}][method]" placeholder="Method">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger" onclick="removeDetailInput(this)">Remove</button>
                </div>
            </div>
        `;
            document.getElementById('detail_inputs').insertAdjacentHTML('beforeend', detailInput);
        }

        // Function to remove detail_laporan input field
        function removeDetailInput(button) {
            button.closest('.row').remove();
        }
    </script>
@endsection
