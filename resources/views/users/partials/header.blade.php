<div class="header">
    <div class="nav-header">
        <div class="brand-logo">
            <a href="index.html">
                <b>
                    <img src="{{url('ule/assets/images/logo.png')}}" alt=""> </b>
                <span class="brand-title">
                    <img src="{{url('ule/assets/images/logo-text.png')}}" alt="">
                </span>
            </a>
        </div>
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
    </div>
    <div class="header-content">
        <div class="header-left">
        </div>
        <div class="header-right">
            <ul>
                <li class="icons">
                    <a href="javascript:void(0)">
                        <i class="mdi mdi-account f-s-20" aria-hidden="true"></i>
                    </a>
                    <div class="drop-down dropdown-profile animated bounceInDown">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('users.logout')}}">
                                        <i class="icon-power"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>