<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">

            @if($active == '/')
                <li
                 v-if="user.role =='admin'"
                 class="menu">
                    <a href="{{URL::to("/administrador/painel")}}" aria-expanded="true" class="dropdown-toggle">
                        <div class="">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span> Inicio </span>
                        </div>
                    </a>
                </li>
            @else
                <li
                 v-if="user.role =='admin'"
                 class="menu">
                    <a href="{{URL::to("/administrador/painel")}}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span> Inicio </span>
                        </div>
                    </a>
                </li>
            @endif

            @if($active == 'projectos')
            <li
            v-if="user.role =='admin'"
            class="menu">
               <a href="#menuprojectos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                   <div class="">
                       <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                       <span> Projectos </span>
                   </div>

                   <div>
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                   </div>

               </a>

               <ul class="submenu list-unstyled collapse" id="menuprojectos" data-parent="#accordionExample" style="">
                   <li>
                       <a href="{{route('ver-projectos')}}"> Ativos </a>
                   </li>
                   <li>
                       <a href="{{route('ver-projectos-eliminados')}}"> Eliminados </a>
                   </li>

               </ul>
           </li>
            @else
                <li
                 v-if="user.role =='admin'"
                 class="menu">
                    <a href="#menuprojectos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                        <div class="">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                            <span> Projectos </span>
                        </div>

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>

                    </a>

                    <ul class="submenu list-unstyled collapse" id="menuprojectos" data-parent="#accordionExample" style="">
                        <li>
                            <a href="{{route('ver-projectos')}}"> Ativos </a>
                        </li>
                        <li>
                            <a href="{{route('ver-projectos-eliminados')}}"> Eliminados </a>
                        </li>
     
                    </ul>
                </li>
            @endif

                @if($active == 'usuarios')
                    <li
                     v-if="user.role =='admin'"
                     class="menu">
                        <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Ver Usuários</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="users" data-parent="#accordionExample" style="">
                            <li>
                                <a href="{{route('ver-usuarios-profissinais')}}"> Profissionais </a>
                            </li>
                            <li>
                                <a href="{{route('ver-usuarios-normais')}}"> Clientes </a>
                            </li>

                            <li>
                                <a href="{{route('ver-operadores')}}"> Operadores </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li
                     v-if="user.role =='admin'"
                     class="menu">
                        <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Ver Usuários</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="users" data-parent="#accordionExample" style="">
                            <li>
                                <a href="{{route('ver-usuarios-profissinais')}}"> Profissionais </a>
                            </li>
                            <li>
                                <a href="{{route('ver-usuarios-normais')}}"> Clientes </a>
                            </li>

                            <li>
                                <a href="{{route('ver-operadores')}}"> Operadores </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if($active == 'categorias')
                    <li
                     v-if="user.role =='admin'"
                     class="menu">
                        <a href="{{URL::to("/administrador/painel/ver/categorias")}}" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                <span> Categorias </span>
                            </div>
                        </a>
                    </li>
                @else
                    <li
                     v-if="user.role =='admin'"
                     class="menu">
                        <a href="{{URL::to("/administrador/painel/ver/categorias")}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                <span> Categorias </span>
                            </div>
                        </a>
                    </li>
                @endif

                @if($active == 'pagamentos')
                    <li 
                     v-if="user.role =='admin'"

                    class="menu">
                        <a href="{{URL::to("/administrador/painel/ver/pagamentos")}}" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                <span> Lista de Pagamentos </span>
                            </div>
                        </a>
                    </li>
                @else
                    <li
                    v-if="user.role =='admin'"

                     class="menu">
                        <a href="{{URL::to("/administrador/painel/ver/pagamentos")}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                <span> Lista de Pagamentos </span>
                            </div>
                        </a>
                    </li>
                @endif

                @if($active == 'parametros')
                    <li
                     v-if="user.role =='admin'"

                     class="menu">
                        <a href="{{route('ver-servicos')}}" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                                <span> Parametrizacão </span>
                            </div>
                        </a>
                    </li>
                @else
                    <li
                     v-if="user.role =='admin'"

                     class="menu">
                        <a href="{{route('ver-servicos')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                                <span> Parametrizacão </span>
                            </div>
                        </a>
                    </li>
                @endif

                @if($active == 'tickets')
                    <li
                     class="menu">
                        <a href="{{route('ver-tickets')}}" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                <span> Tickets </span>
                            </div>
                        </a>
                    </li>
                @else
                    <li class="menu">
                        <a href="{{route('ver-tickets')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                <span> Tickets </span>
                            </div>
                        </a>
                    </li>
                @endif

                @if($active == 'comentarios')

                    <li class="menu">
                        <a href="#comentarios" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle collapsed">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                <span>Comentários</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="comentarios" data-parent="#accordionExample" style="">
                            <li>
                                <a href="{{route('ver-comentarios-pendentes')}}"> Pendentes </a>
                            </li>
                            <li>
                                <a href="{{route('ver-comentarios-aprovados')}}"> Aprovados </a>
                            </li>
                        </ul>
                    </li>

                @else

                    <li class="menu">
                        <a href="#comentarios" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                <span>Comentários</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="comentarios" data-parent="#accordionExample" style="">
                            <li>
                                <a href="{{route('ver-comentarios-pendentes')}}"> Pendentes </a>
                            </li>
                            <li>
                                <a href="{{route('ver-comentarios-aprovados')}}"> Aprovados </a>
                            </li>
                        </ul>
                    </li>

                @endif



                @if($active == 'blacklist')
                    <li
                     v-if="user.role =='admin'"

                     class="menu">
                        <a href="{{route('ver_black-list')}}" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                                <span> Black-List </span>
                            </div>
                        </a>
                    </li>
                @else
                    <li
                    v-if="user.role =='admin'"

                     class="menu">
                        <a href="{{route('ver_black-list')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                                <span> Black-List </span>
                            </div>
                        </a>
                    </li>
                @endif



        </ul>

    </nav>

</div>
