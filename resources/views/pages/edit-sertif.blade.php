@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Sertifikat'])

    <div class="row mt-0 mx-1">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Sertifikat</h6>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form action="{{ route('history-pengajuan.updatesertif', $history->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <label for="no_surat" class="form-label">Nomor Sertifikat</label>
                                <input type="text" class="form-control" id="no_surat" name="no_surat"
                                    value="{{ $history->no_surat }}">
                            </div>

                            <div class="col-md-6">
                                <label for="commodity_surat" class="form-label">Commodity</label>
                                <input type="text" class="form-control" id="commodity_surat" name="commodity_surat"
                                    value="{{ $history->commodity_surat }}">
                            </div>

                            <div class="col-md-6">
                                <label for="noserial_surat" class="form-label">Serial Number</label>
                                <input type="text" class="form-control" id="noserial_surat" name="noserial_surat"
                                    value="{{ $history->noserial_surat }}">
                            </div>

                            <div class="col-md-6">
                                <label for="sample_desc_surat" class="form-label">Sample Description</label>
                                <input type="text" class="form-control" id="sample_desc_surat" name="sample_desc_surat"
                                    value="{{ $history->sample_desc_surat }}">
                            </div>

                            <div class="col-md-6">
                                <label for="code_number_surat" class="form-label">Code of Number</label>
                                <input type="text" class="form-control" id="code_number_surat" name="code_number_surat"
                                    value="{{ $history->code_number_surat }}">
                            </div>

                            <div class="col-md-6">
                                <label for="received_surat" class="form-label">Date of Received</label>
                                <input type="date" class="form-control" id="received_surat" name="received_surat"
                                    value="{{ $history->received_surat ?? now()->format('Y-m-d') }}">
                            </div>

                            <div class="col-md-6">
                                <label for="testing_surat" class="form-label">Date of Testing</label>
                                <input type="date" class="form-control" id="testing_surat" name="testing_surat"
                                    value="{{ $history->testing_surat ?? now()->format('Y-m-d') }}">
                            </div>

                            <div class="col-md-6">
                                <label for="no_sni" class="form-label">No. SNI</label>
                                <input type="text" class="form-control" id="no_sni" name="no_sni"
                                    value="{{ $history->no_sni }}">
                            </div>

                            <div class="col-md-6">
                                <label for="grade" class="form-label">Grade</label>
                                <input type="text" class="form-control" id="grade" name="grade"
                                    value="{{ $history->grade }}">
                            </div>

                            <div class="col-md-6">
                                <label for="note_sertif" class="form-label">Note / Valid time</label>
                                <input type="text" class="form-control" id="note_sertif" name="note_sertif"
                                    value="{{ $history->note_sertif }}">
                            </div>

                            {{-- Form input array --}}
                            <div class="col-md-12 mt-3">
                                <label for="detail" class="form-label">Detail</label>
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        Characteristic
                                    </div>
                                    <div class="col-md-2 text-center">
                                        Method
                                    </div>
                                    <div class="col-md-2 text-center">
                                        Unit
                                    </div>
                                    <div class="col-md-2 text-center">
                                        Test Result
                                    </div>
                                    <div class="col-md-2 text-center">
                                        Grade Limit
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                                <div id="detail_inputs">
                                    @if ($history->detail)
                                        @foreach (json_decode($history->detail) as $index => $detail)
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control"
                                                        name="detail[{{ $index }}][characteristic]"
                                                        value="{{ $detail->characteristic }}" placeholder="Characteristic">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control"
                                                        name="detail[{{ $index }}][method]"
                                                        value="{{ $detail->method }}" placeholder="Method">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="detail[{{ $index }}][unit]" value="{{ $detail->unit }}"
                                                        placeholder="Unit">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="detail[{{ $index }}][test]" value="{{ $detail->test }}"
                                                        placeholder="Test Result">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="detail[{{ $index }}][grade]" value="{{ $detail->grade }}"
                                                        placeholder="Grade Limit">
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
                                                <input type="text" class="form-control" name="detail[0][characteristic]"
                                                    placeholder="Characteristic">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="detail[0][method]"
                                                    placeholder="Method">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="detail[0][unit]"
                                                    placeholder="Unit">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="detail[0][test]"
                                                    placeholder="Test Result">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="detail[0][grade]"
                                                    placeholder="Grade Limit">
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
        // Function to add detail input field
        function addDetailInput() {
            let index = document.querySelectorAll('#detail_inputs .row').length;
            let detailInput = `
            <div class="row">
                <div class="col-md-2">
                    <input type="text" class="form-control" name="detail[${index}][characteristic]" placeholder="Characteristic">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="detail[${index}][method]" placeholder="Method">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="detail[${index}][unit]" placeholder="Unit">
                </div>  
                <div class="col-md-2">
                    <input type="text" class="form-control" name="detail[${index}][test]" placeholder="Test Result">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="detail[${index}][grade]" placeholder="Grade Limit">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger" onclick="removeDetailInput(this)">Remove</button>
                </div>
            </div>
        `;
            document.getElementById('detail_inputs').insertAdjacentHTML('beforeend', detailInput);
        }

        // Function to remove detail input field
        function removeDetailInput(button) {
            button.closest('.row').remove();
        }
    </script>
@endsection
