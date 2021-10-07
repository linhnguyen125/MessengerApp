<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{Auth::user()->name}}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <link rel="icon" href="{{asset('images/messenger.ico')}}" type="image/x-icon" />
</head>
<body>
    <style>
        /* The alert message box */
        .alert-success {
        padding: 20px;
        background-color: #39a53e; /* Red */
        color: white;
        margin-bottom: 15px;
        }

        .alert-error {
        padding: 20px;
        background-color: #f44336; /* Red */
        color: white;
        margin-bottom: 15px;
        }

        /* The close button */
        .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
        }

        /* When moving the mouse over the close button */
        .closebtn:hover {
        color: black;
        }

        .modal {
        display: none; /* Ẩn Mặc Định */
        position: fixed;
        z-index: 1;
        padding-top: 300px; /* Vị trí của modal */
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%;
        overflow: auto; /* thiết lập scroll khi cần thiết */
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
        }
        #myBtn {
        background-color: #4CAF50; 
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        -webkit-transition-duration: 0.4s; /* Safari */
        transition-duration: 0.4s;
            box-shadow: 0 1px 1px rgba(0,0,0,0.12),
                    0 2px 2px rgba(0,0,0,0.12),
                    0 4px 4px rgba(0,0,0,0.12),
                    0 8px 8px rgba(0,0,0,0.12),
                    0 16px 16px rgba(0,0,0,0.12);
        outline: none;
        }
        /* Nội Dung Modal */
        .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        box-shadow: 0 1px 1px rgba(0,0,0,0.12),
                    0 2px 2px rgba(0,0,0,0.12),
                    0 4px 4px rgba(0,0,0,0.12),
                    0 8px 8px rgba(0,0,0,0.12),
                    0 16px 16px rgba(0,0,0,0.12);
        border-radius: 25px;
        }
        /* Nút Đóng Modal */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            padding: 40px 0px 40px 0px;
        }
        .close:hover,
        .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }
    </style>
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="/">Trang chủ</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form>
        <!-- User -->

        <!-- Modal Cho Website -->
        <div id="myModal" class="modal">
        <!-- Nội Dung Modal -->
            <div class="modal-content">
            <span class="close">×</span>
            <form action="{{route('updateAvatar', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="avatar">Thay đổi ảnh đại diện</label><br>
                    <input type="file" name="avatar" class="form-control-file" id="avatar"><br> <br>
                    <button type="submit" class="btn btn-primary">Thay đổi</button>
                  </div>
            </form>
            </div>
        </div>

        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{asset(Auth::user()->avatar)}}">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->name}}</span>
                </div>
              </div>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url({{asset(Auth::user()->avatar)}})">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello {{Auth::user()->name}}</h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image" id="myBtn">
                    <img src="{{asset(Auth::user()->avatar)}}" class="rounded-circle">
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                        <div>
                            <span class="heading">22</span>
                            <span class="description">Friends</span>
                        </div>
                        <div>
                            <span class="heading">10</span>
                            <span class="description">Photos</span>
                        </div>
                        <div>
                            <span class="heading">89</span>
                            <span class="description">Comments</span>
                        </div>
                    </div>
                </div>
              </div>
                <div class="text-center">
                    <h3>
                        {{Auth::user()->name}}<span class="font-weight-light">, 27</span>
                    </h3>
                    <div class="h5 font-weight-300">
                        <i class="ni location_pin mr-2"></i>Bucharest, Romania
                    </div>
                        <div class="h5 mt-4">
                        <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                    </div>
                        <div>
                        <i class="ni education_hat mr-2"></i>University of Computer Science
                    </div>
                    <hr class="my-4">
                    <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
                    <a href="#">Show more</a>
                </div>
                </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div>
              </div>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert-error">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        {{session('error')}}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert-success">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        {{session('success')}}
                    </div>
                @endif
                <form action="{{route('update', Auth::user()->id)}}" method="POST">
                    @csrf
                    <h6 class="heading-small text-muted mb-4">User information</h6>
                    <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-username">Username</label>
                            <input type="text" name="name" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="{{Auth::user()->name}}">
                        </div>
                        @error('name')
                            <div style="color: red" class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-email">Email address</label>
                            <input type="email" readonly name="email" id="input-email" class="form-control form-control-alternative" placeholder="{{Auth::user()->email}}" value="{{Auth::user()->email}}">
                        </div>
                        @error('email')
                            <div style="color: red" class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    </div>
                    <hr class="my-4">
                    <!-- Address -->
                    {{-- <h6 class="heading-small text-muted mb-4">Contact information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group focused">
                                <label class="form-control-label" for="input-address">Address</label>
                                <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" value="Cu lok" type="text">
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="input-city">City</label>
                                <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" value="New York">
                            </div>
                            </div>
                            <div class="col-lg-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="input-country">Country</label>
                                <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" value="United States">
                            </div>
                            </div>
                            <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-country">Postal code</label>
                                <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code">
                            </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4"> --}}
                    <!-- Description -->
                    <h6 class="heading-small text-muted mb-4">About me</h6>
                    <div class="pl-lg-4">
                        <div class="form-group focused">
                            <label>About Me</label>
                            <textarea rows="4" name="about_me" class="form-control form-control-alternative" placeholder="A few words about you ...">{{Auth::user()->about_me}}</textarea>
                        </div>
                    </div>

                    <div class="pl-lg-4 float-right">
                        <div class="form-group focused">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <div class="copyright">
          <p>Made with <a href="https://www.creative-tim.com/product/argon-dashboard" target="_blank">Argon Dashboard</a> by Creative Tim</p>
        </div>
      </div>
    </div>
  </footer>

  <script>
      /* lấy phần tử modal */
        var modal = document.getElementById("myModal");
        /* thiết lập nút mở modal */
        var btn = document.getElementById("myBtn");
        /* thiết lập nút đóng modal */
        var span = document.getElementsByClassName("close")[0];
        /* Sẽ hiển thị modal khi người dùng click vào */
        btn.onclick = function() {
        modal.style.display = "block";
        }
        /* Sẽ đóng modal khi nhấn dấu x */
        span.onclick = function() {
        modal.style.display = "none";
        }
        /*Sẽ đóng modal khi nhấp ra ngoài màn hình*/
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
  </script>
</body>
</html>