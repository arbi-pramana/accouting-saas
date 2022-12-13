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
                                <h4 class="text-center m-t-15">Masukan kata sandi baru</h4>
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
                                <form class="m-t-30 m-b-30" action="{{route('users.forgot-password.storeNewPassword')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="token" value="{{request('token')}}">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                    <div class="text-center m-b-15 m-t-15">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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