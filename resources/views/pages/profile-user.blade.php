@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile User'])

    <div class="row mt-0 mx-1">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Profile User</h6>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form action="{{ route('profile-user.update', $userr->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Fullname</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $userr->fullname }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $userr->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Jika ingin ganti password)</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
{{-- 
                        <div class="mb-3">
                            <label for="confirmpassword" class="form-label">Konfirmasi Password</label>
                            <input type="confirmpassword" class="form-control" id="confirmpassword" name="confirmpassword" required>
                        </div> --}}

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
