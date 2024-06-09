<header class="header navbar navbar-expand-sm">

    <ul class="navbar-item theme-brand flex-row  text-center">
        <li class="nav-item theme-logo">
            <a href="/">
                <img src="{{URL::asset('assets/img/original/bumbeiros-logo-white.svg')}}" class="navbar-logo" alt="logo">
            </a>
        </li>
    </ul>

    <ul class="navbar-item flex-row ml-md-auto">

        <li class="nav-item dropdown user-profile-dropdown">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <img src="{{asset('imgs/default.png')}}" alt="avatar">
            </a>
            <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                <div class="">

                    <div class="dropdown-item">
                        <a class="" id="username"  href="#">Sair</a>
                    </div>


                    <div class="dropdown-item">
                        <a class="" onclick="sair()" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Sair</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</header>

<script>
 document.getElementById("username").innerHTML = JSON.parse(localStorage.getItem('user'))['name'];
</script>
