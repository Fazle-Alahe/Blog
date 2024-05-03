
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">
    
    
    <!-- Mirrored from myrathemes.com/dashtrap/pages-login by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2024 03:40:33 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
    <head>
        <meta charset="utf-8" />
        <title>Log In | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Myra Studio" name="author" />
    
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('backend/assets')}}/images/favicon.ico">
    
        <!-- App css -->
        <link href="{{asset('backend/assets')}}/css/style.min.css" rel="stylesheet" type="text/css">
        <link href="{{asset('backend/assets')}}/css/icons.min.css" rel="stylesheet" type="text/css">
        <script src="{{asset('backend/assets')}}/js/config.js"></script>

        
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        
	<style>
		.blg_circle{
			height: 70px;
			width: 70px;
			border-radius: 50%;
		}
		.mini_circle{
			height: 35px;
			width: 35px;
			border-radius: 50%;
		}

        .toggle-password {
            float: right;
            cursor: pointer;
            margin-right: 10px;
            margin-top: -25px;
        }
        
        .swal2-container.swal2-backdrop-show{
            background-color: none !important;
        }

        .swal2-popup.swal2-toast{
            background: rgb(8, 157, 26) !important;
			padding: 8px !important;
        }
		.swal2-title{
			font-weight: 500;
			font-size: 1.2rem;
			color: white}

	</style>
    </head>
    
    <body class="bg-primary d-flex justify-content-center align-items-center min-vh-100 p-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-5">
                    <div class="card">
                        <div class="card-body p-4">
    
                            <div class="text-center w-75 mx-auto auth-logo mb-4">
                                <a class='logo-dark' href='index.html'>
                                    <span><img src="{{asset('backend/assets')}}/images/logo-dark.png" alt="" height="22"></span>
                                </a>
    
                                <a class='logo-light' href='index.html'>
                                    <span><img src="{{asset('backend/assets')}}/images/logo-light.png" alt="" height="22"></span>
                                </a>
                            </div>
    
                            <form action="{{route('login.post')}}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Email address</label>
                                    <input class="form-control" type="email" name="email">
                                    @error('email')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
    
                                <div class="form-group mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input class="form-control" type="password" name="password">
                                    @error('password')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
    
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary w-100" type="submit"> Log In </button>
                                </div>
    
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
    
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50"> <a class='text-white-50 ms-1' href='pages-register.html'>Forgot your password?</a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
    
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    
        <!-- App js -->
        <script src="{{asset('backend/assets')}}/js/vendor.min.js"></script>
        <script src="{{asset('backend/assets')}}/js/app.js"></script>

        

    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
   
    @if (session('blocked'))
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
    
        Toast.fire({
        icon: 'success',
        title: '{{session('blocked')}}'
        })
    </script>
    @endif

    </body>
    
    
    <!-- Mirrored from myrathemes.com/dashtrap/pages-login by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2024 03:40:33 GMT -->
    </html>