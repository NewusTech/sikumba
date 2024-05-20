@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Penilaian'])

    <div class="row mt-0 mx-1">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                    <div>
                        <h6 class="mt-1">Penilaian Pelanggan</h6>
                    </div>
                    <div>
                        <form class="d-flex align-items-center">
                            <input id="search" class="form-control mr-5" type="text" name="search"
                                placeholder="Search...">
                        </form>
                    </div>
                </div>
                <div class="card-header py-0 mt-2">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mb-2">
                            <small class="d-block">Tanggal Awal</small>
                            <input class="form-control" type="date" id="dateawal" name="dateawal">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <small class="d-block">Tanggal Akhir</small>
                            <input class="form-control" type="date" id="dateakhir" name="dateakhir">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <small class="d-block">Rating</small>
                            <select id="rating" class="form-control" name="rating" required>
                                <option value="">Pilih Penilaian</option>
                                <option value="sangat_memuaskan">Sangat Memuaskan</option>
                                <option value="memuaskan">Memuaskan</option>
                                <option value="cukup_memuaskan">Cukup Memuaskan</option>
                                <option value="buruk">Buruk</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-end">
                        <a id="export-button" href="{{ route('export-survey') }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                        </a>
                    </div>
                </div>
                
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3" id="search-list">
                        <table class="table align-items-center mb-5">
                            <thead class="thead-light table-bordered">
                                <tr>
                                    <th class="border text-center">Name</th>
                                    <th class="border text-center">Date</th>
                                    <th class="border text-center">No. HP</th>
                                    <th class="border text-center">Penilaian</th>
                                    <th class="border text-center">Komentar</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered">
                                @forelse ($survey as $item)
                                    <tr>
                                        <td class="border">{{ $item->name }}</td>
                                        <td class="border">{{ $item->created_at }}</td>
                                        <td class="border">{{ $item->no_handphone }}</td>
                                        <td class="border">
                                            @if ($item->rating == 'sangat_memuaskan')
                                                sangat memuaskan
                                            @elseif($item->rating == 'cukup_memuaskan')
                                                cukup memuaskan
                                            @else
                                                {{ $item->rating }}
                                            @endif
                                        </td>
                                        <td class="border">{{ $item->comments }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="16" class="font-weight-bold border text-center">Tidak ada data yang
                                            dapat ditampilkan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div id="pagination">
                            {{ $survey->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle live search
            $('#search').on('keyup', function() {
                fetch_data();
            });

            $('#dateawal').on('change', function() {
                fetch_data();
            });

            $('#dateakhir').on('change', function() {
                fetch_data();
            });

            $('#rating').on('change', function() {
                fetch_data();
            });

            // Handle pagination links
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            // Fetch data function
            function fetch_data(page = 1) {
                var query = $('#search').val();
                var dateawal = $('#dateawal').val();
                var dateakhir = $('#dateakhir').val();
                var rating = $('#rating').val();
                var baseUrl = "{!! url('/review-user-search') !!}?query=" + query + "&dateawal=" +
                    dateawal + "&dateakhir=" + dateakhir + "&rating=" + rating;
                $.ajax({
                    url: baseUrl,
                    type: 'GET',
                    data: {
                        page: page,
                    },
                    success: function(data) {
                        $('#search-list').html(data);
                    }
                });
            }
        });
    </script>

    <script>
        document.getElementById('export-button').addEventListener('click', function() {
            var search = document.getElementById('search').value;
            var dateawal = document.getElementById('dateawal').value;
            var dateakhir = document.getElementById('dateakhir').value;
            var rating = document.getElementById('rating').value;
            var exportUrl = this.getAttribute('href') + '?searchh=' + search +
                "&dateawal=" + dateawal + "&dateakhir=" + dateakhir + "&rating=" + rating;
            this.setAttribute('href', exportUrl);
        });
    </script>
@endsection
