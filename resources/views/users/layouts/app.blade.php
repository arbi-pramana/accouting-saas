<!DOCTYPE html>
<html lang="en">
@include('users.partials.head')
@yield('css')
<body class="v-light vertical-nav fix-header fix-sidebar">
    @include('users.partials.preloader')
    <div id="main-wrapper">
        <!-- header -->
        @include('users.partials.header')
        <!-- #/ header -->
        <!-- sidebar -->
        @include('users.partials.sidebar')
        <!-- #/ sidebar -->
        <!-- content body -->
        <div class="content-body">
            @yield('content')
        </div>
        <!-- #/ content body -->
        <!-- footer -->
        @include('users.partials.footer')
        <!-- #/ footer -->
    </div>
    @include('users.partials.scripts')
    @yield('scripts')
</body>

</html>