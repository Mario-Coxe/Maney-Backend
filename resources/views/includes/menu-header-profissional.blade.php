

<header class="header navbar navbar-expand-sm">

    <ul class="navbar-item theme-brand flex-row  text-center">
        <li class="nav-item theme-logo">
            <a href="/">
                <img src="{{URL::asset('assets/img/original/bumbeiros-logo-white.svg')}}" class="navbar-logo" alt="logo">
            </a>
        </li>
    </ul>

    <ul class="navbar-item flex-row ml-md-auto">

        <!--<li class="nav-item dropdown language-dropdown">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('assets/img/job.png')}}" class="flag-width" alt="flag">
            </a>
            <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                <a data-toggle="modal" data-target="#trocar" class="dropdown-item d-flex" href="javascript:void(0);"><span class="align-self-center">&nbsp;Mudar Para Cliente</span></a>
            </div>
        </li>-->

        <li class="nav-item dropdown message-dropdown">
            <a href="/profissional/propostas" class="nav-link dropdown-toggle" id="messageDropdown"  aria-haspopup="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            </a>
        </li>
        <li class="nav-item dropdown notification-dropdown">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span
                    v-if="notificacoes != ''"
                    class="badge badge-success"></span>
            </a>
            <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                <div class="notification-scroll">


                    <div
                        v-for="notificacao in notificacoes"
                        class="dropdown-item">
                        <div class="media">
                            <div class="media-body">
                                <div class="notification-para">@{{ notificacao.description }}</div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </li>

        <li class="nav-item dropdown user-profile-dropdown">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <img
                 v-if="eu.foto == 'NULL'"
                 src="{{URL::asset('assets/img/90x90.jpg')}}" alt="avatar">

                 <img
                 v-else
                 :src="`/${eu.foto}`" alt="avatar">
            </a>
            <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                <div class="">
                    <div class="dropdown-item">
                        <a class="" href="{{URL::to('/profissional/meu-perfil')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Meu Perfil</a>
                    </div>

                    <div class="dropdown-item">
                        <a class="" onclick="sair()" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Sair</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</header>
