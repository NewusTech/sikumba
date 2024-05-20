@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Master Commodity'])
<div class="row mt-0 mx-1">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-start align-items-center">
                <h6 class="mt-1">Commodity</h6>
                <a class="nav-link" href="{{ route('commodity.create') }}">
                    <i class="ni ni-fat-add"></i> Create
                </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Keterangan
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commodity as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->kode }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->keterangan }}</h6>
                                        </div>
                                    </div>
                                </td>
                                {{-- <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <p class="text-sm font-weight-bold mb-0 cursor-pointer">Edit</p>
                                                <p class="text-sm font-weight-bold mb-0 ps-2 cursor-pointer">Delete</p>
                                            </div>
                                        </td> --}}
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <a href="{{ route('commodity.edit', $item->id) }}" class="text-sm font-weight-bold mb-0 ps-2" style="color: green; margin-right: 10px">Edit</a>

                                        <form action="{{ route('commodity.delete', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-sm font-weight-bold mb-0 cursor-pointer border-0 bg-white" onclick="return confirm('Are you sure you want to delete this commodity?')" style="color: red">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection