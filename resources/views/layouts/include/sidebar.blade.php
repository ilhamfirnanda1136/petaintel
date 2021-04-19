 <!-- partial:{{asset('')}}/partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="profile-image">
                                <img class="img-xs rounded-circle" src="{{asset('img/noimage.jpg')}}"
                                    alt="profile image">
                                <div class="dot-indicator bg-success"></div>
                            </div>
                            <div class="text-wrapper">
                                <p class="profile-name"> {{ Auth::user()->name }}</p>
                                <p class="designation">Admin</p>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Main Menu</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/home')}}">
                            <i class="menu-icon typcn typcn-mail"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                      <li class="nav-item nav-category">Jenis Peta</li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false"
                            aria-controls="page-layouts">
                            <i class="menu-icon typcn typcn-archive"></i>
                            <span class="menu-title">Kerawanan Konflik Sosial</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="page-layouts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/master/konflik')}}">Master Konflik</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/konflik')}}">Form Peta Konflik</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#page-radikalisme" aria-expanded="false"
                            aria-controls="page-radikalisme">
                            <i class="menu-icon typcn typcn-archive"></i>
                            <span class="menu-title">Kerawanan Radikalisme</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="page-radikalisme">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/master/radikalisme')}}">Master Jenis Radikalisme</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/radikalisme')}}">Form Peta Radikalisme</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/pakem')}}">
                            <i class="menu-icon typcn typcn-mail"></i>
                            <span class="menu-title">Peta Aliran Kepercayaan</span>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{url('/asing')}}">
                            <i class="menu-icon typcn typcn-mail"></i>
                            <span class="menu-title">Peta Pengawasan Orang Asing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#page-lsm" aria-expanded="false"
                            aria-controls="page-lsm">
                            <i class="menu-icon typcn typcn-archive"></i>
                            <span class="menu-title">Peta LSM / Ormas</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="page-lsm">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('master/lsm')}}">Master LSM</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/lsm')}}">Form Peta LSM/Ormas</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#page-pemilukada" aria-expanded="false"
                            aria-controls="page-pemilukada">
                            <i class="menu-icon typcn typcn-archive"></i>
                            <span class="menu-title">Peta Pemilukada</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="page-pemilukada">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('master/paslon')}}">Master Paslon</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/paslon/suara')}}">Form Perolehan Suara Paslon</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#page-pemiloparpol" aria-expanded="false"
                            aria-controls="page-pemiloparpol">
                            <i class="menu-icon typcn typcn-archive"></i>
                            <span class="menu-title">Peta Pemilu Partai Politik</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="page-pemiloparpol">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('master/parpol')}}">Master Parpol</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/parpol/suara')}}">Form Perolehan Suara Parpol</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/vaksinasi')}}">
                            <i class="menu-icon typcn typcn-mail"></i>
                            <span class="menu-title">Peta Vaksinasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('bencana')}}">
                            <i class="menu-icon typcn typcn-mail"></i>
                            <span class="menu-title">Peta Rawan Bencana</span>
                        </a>
                    </li>
                    @if(Auth::user()->level == 1)
                     <li class="nav-item nav-category">Admin</li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('/user')}}">
                            <i class="menu-icon typcn typcn-mail"></i>
                            <span class="menu-title">User</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>