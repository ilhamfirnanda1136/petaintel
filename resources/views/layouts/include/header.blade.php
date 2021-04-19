 <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="#">
                    <img src="{{asset('img/logodashboard.png')}}" alt="logo"  style="width:100px"/> </a>
                <a class="navbar-brand brand-logo-mini" href="#">
                    <img src="{{asset('img/logodashboard.png')}}" alt="logo" style="width:100px" /> </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown language-dropdown">
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{asset('img/noimage.jpg')}}"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{asset('')}}/assets/images/faces/face8.jpg"
                                    alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold" >{{ Auth::user()->name }}</p>
                                <p class="font-weight-light text-muted mb-0"> {{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{url('profile')}}" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary"></i> My Profile</a>
                            <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout').submit();"><i onclick="event.preventDefault();document.getElementById('logout').submit();" class="dropdown-item-icon mdi mdi-power text-primary"></i>Sign
                                Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>