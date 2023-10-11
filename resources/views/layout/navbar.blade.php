<div class="navbar-collapse justify-content-end px-0" id="navbarNav">
    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        {{-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> --}}
        <li class="nav-item dropdown">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="{{ asset('src') }}/assets/images/profile/android-chrome-512x512.png" alt=""
                    width="35" height="35" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                <div class="message-body">
                    <a href="/newhome" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-home-2 fs-6"></i>
                        <p class="mb-0 fs-3">Home</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-user fs-6"></i>
                        <p class="mb-0 fs-3">My Profile</p>
                    </a>

                    {{-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-list-check fs-6"></i>
                        <p class="mb-0 fs-3">My Task</p>
                    </a> --}}
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary mx-5 mt-2 d-block">
                            logout
                        </button>
                    </form>
                    {{-- <a href="/logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a> --}}
                </div>
            </div>
        </li>
    </ul>
</div>
