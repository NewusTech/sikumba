<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" target="_blank">
            <!-- <img src="./img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> -->
            <h4 class="font-weight-bold">SIKUMBA</h4>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (!empty($user) && $user->roles->contains('name', 'Admin'))
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">MASTER</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'user-management' ? 'active' : '' }}"
                        href="{{ route('user-management') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'verification-index' ? 'active' : '' }}"
                        href="{{ route('verification-index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-active-40 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">User Verification</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'data-sertifikat' ? 'active' : '' }}"
                        href="{{ route('data-sertifikat') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Sertification</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'commodity' ? 'active' : '' }}"
                        href="{{ route('commodity') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Commodity</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'logo' ? 'active' : '' }}"
                        href="{{ route('logo') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Gambar Logo</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'kontak' ? 'active' : '' }}"
                        href="{{ route('kontak') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-phone text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kontak BPSMB</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Survey</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'review-user' ? 'active' : '' }}"
                        href="{{ route('review-user') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Penilaian Pelanggan</span>
                    </a>
                </li>
            @endif
            @if (!empty($user) && $user->roles->contains('name', 'User'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'report-user' ? 'active' : '' }}"
                        href="{{ route('report-user') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Riwayat Pengujian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'report-kalibrasi-user' ? 'active' : '' }}"
                        href="{{ route('report-kalibrasi-user') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Riwayat Kalibrasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'form' ? 'active' : '' }}"
                        href="{{ route('form') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Form Pengujian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'formkalibrasi' ? 'active' : '' }}"
                        href="{{ route('formkalibrasi') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Form Kalibrasi</span>
                    </a>
                </li>
                @php
                    $kontak = \App\Models\Kontak::first();
                @endphp


                <div class="contact-whatsapp">
                    <a href="https://wa.me/{{ $kontak->no_telephone }}?text=Halo admin BPSMB, Saya butuh bantuan."
                        target="_blank">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fab fa-whatsapp text-success text-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Hubungi Kami</span>
                    </a>
                </div>
            @endif
            @if (!empty($user) && (!$user->roles->contains('name', 'User') && !$user->roles->contains('name', 'Admin')))
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'history-pengajuan' ? 'active' : '' }}"
                        href="{{ route('history-pengajuan') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Riwayat Pengujian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'history-kalibrasi' ? 'active' : '' }}"
                        href="{{ route('history-kalibrasi') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Riwayat Kalibrasi</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
