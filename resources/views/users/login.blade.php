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
                                <h4 class="text-center m-t-15">Masuk ke Akun Anda</h4>
                                @if (\Session::has('danger'))
                                    <div class="alert alert-danger">
                                        {!! \Session::get('danger') !!}
                                    </div>
                                @endif
                                @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                        {!! \Session::get('success') !!}
                                    </div>
                                @endif
                                <form class="m-t-30 m-b-30" action="{{route('users.auth')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <div class="form-check p-l-0">
                                                <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                <label class="form-check-label" for="basic_checkbox_1">Ingat Saya</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 text-right"><a href="{{route('users.forgot-password')}}">Lupa Password?</a>
                                        </div>
                                    </div>
                                    <div class="text-center m-b-15 m-t-15">
                                        <button type="submit" class="btn btn-primary">Masuk</button>
                                    </div>
                                </form>
                                <div class="text-right">Tidak memiliki akun? <a href="{{route('users.register')}}">Daftar</a></div>
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