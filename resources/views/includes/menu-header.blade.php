<header class="header navbar navbar-expand-sm">

    <ul class="navbar-item theme-brand flex-row  text-center">
        <li class="nav-item theme-logo">
            <a href="/">
                <img src="{{URL::asset('assets/img/original/bumbeiros-logo-white.svg')}}" class="navbar-logo" alt="logo">
            </a>
        </li>
    </ul>

    <ul class="navbar-item flex-row ml-md-auto">

        <li 
        v-if="double == true"
        class="nav-item dropdown language-dropdown">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('assets/img/job.png')}}" class="flag-width" alt="flag">
            </a>
            <div
                class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                <a data-toggle="modal" data-target="#trocar" class="dropdown-item d-flex" href="javascript:void(0);"><span class="align-self-center">&nbsp;Mudar Para Profissional</span></a>
            </div>
        </li>

        <li class="nav-item dropdown message-dropdown">
            <a href="/painel/propostas" class="nav-link dropdown-toggle" id="messageDropdown"  aria-haspopup="true">
                <i data-feather="mail"></i>
            </a>
        </li>
        <li class="nav-item dropdown notification-dropdown">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i data-feather="bell"></i>
                <span
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
                                <div class="notification-para"><a class="notification" :data-id="notificacao.id" :data-chat="notificacao.chat_id" :data-body="notificacao.body" :data-type="notificacao.type" href="#" data-toggle="modal" data-target="#notificationModal">@{{ notificacao.description }}</a></div>
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
                        <a class="" href="{{URL::to('/painel/meu-perfil')}}">
                         <i data-feather="user"></i>
                         Meu Perfil</a>
                    </div>


                    <div
                        v-if="double == false"
                        class="dropdown-item">
                        <a data-toggle="modal" data-target="#upgrade" href="#">
                        <i data-feather="chevrons-up"></i>Ser Profissional
                        </a>
                    </div>

                    <div class="dropdown-item">
                        <a class="" onclick="sair()" href="#"><i data-feather="log-out"></i> Sair</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</header>
