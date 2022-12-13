<!DOCTYPE html>
<html lang="en" class="h-100" id="login-page1">

@include('users.partials.head')

<body class="h-100">
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/></svg>
        </div>
    </div>
    <div class="login-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card">
                            <div class="card-body">
                                <div class="logo text-center">
                                    <a href="index.html">
                                        <img src="ule/assets/images/f-logo.png" alt="">
                                    </a>
                                </div>
                                <h4 class="text-center m-t-15">Daftarkan akun Anda</h4>
                                @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                        {!! \Session::get('success') !!}
                                    </div>
                                @endif
                                <form class="m-t-30 m-b-30" action="{{route('users.register.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Full Name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" placeholder="+6812xxxxxxxx" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="confirm_password">
                                    </div>
                                    <div class="text-center m-b-15 m-t-15">
                                        <button type="submit" class="btn btn-primary">Daftar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    @include('users.partials.scripts')
</body>

</html>