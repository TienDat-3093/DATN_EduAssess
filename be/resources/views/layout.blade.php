<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrfToken" content="{{ csrf_token() }}">
    <title>Edu Assess</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/logos/logo(2).png')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <!-- link icon boostrap -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <!-- link boostrap -->
    <script src="{{ asset('bootstrap-5.2.3/css/bootstrap.min.css') }}"></script>
    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
</head>
<style>
    .preview-img,
    .question-img {
        max-height: 100px;
        max-width: 100px;
        margin-top: 10px;
    }
</style>
@auth
<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="/" class="text-nowrap logo-img">
                        <img src="{{asset('assets/images/logos/logo(1).png')}}" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">UI COMPONENTS</span>
                        </li>
                        @if(Auth::check() && Auth::user()->admin_role >= 2)
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Admin</span>
                            </a>
                        </li>
                        @endif
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/user" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/question" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Question</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/topic" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Topic</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/tag" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Tags</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/test" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Tests</span>
                            </a>
                        </li>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
          <!-- Modal Edit User -->
 <div class="modal fade" id="MyProfile" tabindex="-1" style="display: none;" aria-hidden="true">
 <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Edit Profile</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
            <form action="{{ route('editProfile', ['id' => Auth::user()->id] )}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                 <div class="row">
                     <div class="col mb-3">
                         <label for="editProfileUserName" class="form-label">Username</label>
                         <div class="input-group">
                             <input type="text" value="{{Auth::user()->username}}" id="editProfileUsername" name="username" class="form-control" placeholder="Enter username">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col mb-3">
                         <label for="createProfileEmail" class="form-label">Email</label>
                         <div class="input-group">
                             <input type="email" value="{{Auth::user()->email}}" id="createProfileEmail" name="email" class="form-control" placeholder="Enter email">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col mb-3">
                         <label for="oldPassword" class="form-label">Old Password</label>
                         <div class="input-group">
                             <input type="password" id="oldPassword" name="old_password" class="form-control" placeholder="Enter password">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col mb-3">
                         <label for="createPassword" class="form-label">New Password</label>
                         <div class="input-group">
                             <input type="password" id="createPassword" name="password" class="form-control" placeholder="Enter password">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col mb-3">
                         <label for="createRePassword" class="form-label">Confirm Password</label>
                         <div class="input-group">
                             <input type="password" id="createRePassword" name="password_confirmation" class="form-control" placeholder="Re-Enter password">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col mb-3">
                         <label for="editProfileDateofbirth" class="form-label">Date of Birth</label>
                         <div class="input-group">
                             <input type="date" value="{{Auth::user()->date_of_birth}}" id="editProfileDateofbirth" name="date_of_birth" class="form-control">
                         </div>
                     </div>
                 </div>
                <label class="btn btn-outline-secondary mb-0" for="editProfileInputUser">
                    <span class="ti ti-upload"></span>
                </label>
                <input type="file" name="image" class="form-control d-none" id="editProfileInputUser" onchange="previeweditProfile()">
                <div id="editProfileFileUser" name="editProfileFileUser" class="mt-2">
                    <img class="preview-img" src="{{Auth::user()->image}}"></img>
                </div>
            </div>
            <div class="modal-footer">
                 <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
            </form>
         </div>
     </div>
     </div>
     <!--  Modal Ends -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('img/users/default.png') }}" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <button type="button" class="d-flex align-items-center gap-2 dropdown-item" data-bs-toggle="modal" data-bs-target="#MyProfile">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </button>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="{{ route('logout') }}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
    </div>
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/dist/simplebar.js')}}"></script>
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
    @if (session('alert'))
    <script>
        Swal.fire("{{ session('alert') }}")
    </script>
    @endif
    <script>
        function previeweditProfile() {
        const fileInput = document.getElementById(`editProfileInputUser`);
        const fileUser = document.getElementById(`editProfileFileUser`);
        const file = fileInput.files[0];
        fileUser.innerHTML = '';
        if (file) {
            const fileName = document.createElement('p');
            fileName.textContent = `Selected file: ${file.name}`;
            fileUser.appendChild(fileName);
            if (file.type.startsWith('image/')) {
                const imgUser = document.createElement('img');
                imgUser.classList.add('preview-img');
                imgUser.src = URL.createObjectURL(file);
                fileUser.appendChild(imgUser);
                }
            }
        }
    </script>
</body>
@endauth
</html>