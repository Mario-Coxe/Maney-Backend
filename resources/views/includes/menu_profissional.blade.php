<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">

            @if($active == '/')
                <li class="menu">
                    <a href="{{URL::to("/profissional")}}" aria-expanded="true" class="dropdown-toggle">
                        <div class="">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span> Projectos </span>
                        </div>
                    </a>
                </li>
            @else
                <li class="menu">
                    <a href="{{URL::to("/profissional")}}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span> Projectos </span>
                        </div>
                    </a>
                </li>
            @endif
            
            <li class="menu">
                    <a href="{{route('propostas')}}"   class="dropdown-toggle">
                        <div class="">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            <span>Propostas</span>
                        </div>
                    </a>
                </li>

                @if($active == 'pagamentos')
                    <li class="menu">
                        <a href="{{URL::to("/profissional/meus-pagamentos")}}" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                <span> Pagamentos </span>
                            </div>
                        </a>
                    </li>
                @else
                    <li class="menu">
                        <a href="{{URL::to("/profissional/meus-pagamentos")}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                <span> Pagamentos </span>
                            </div>
                        </a>
                    </li>
                @endif

                @if($active == 'avaliacao')
                    <li class="menu">
                        <a href="{{URL::to("/profissional/avaliacao")}}" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <span> Avaliaçoes </span>
                            </div>
                        </a>
                    </li>
                @else
                    <li class="menu">
                        <a href="{{URL::to("/profissional/avaliacao")}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <span> Avaliaçoes </span>
                            </div>
                        </a>
                    </li>
                @endif

                @if($active == 'ajuda')

                    <li class="menu">
                        <a href="#users" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle collapsed">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                <span>Ajuda</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="users" data-parent="#accordionExample" style="">
                            <li>
                                <a href="{{route('ajuda-profissional')}}"> Central de Ajuda </a>
                            </li>
                            <li>
                                <a href="{{route('meus-tickets-profissional')}}">Problemas Reportados</a>
                            </li>

                        </ul>
                    </li>
                @else
                     <li class="menu">
                        <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                <span>Ajuda</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="users" data-parent="#accordionExample" style="">
                            <li>
                                <a href="{{route('ajuda-profissional')}}"> Central de Ajuda </a>
                            </li>
                            <li>
                                <a href="{{route('meus-tickets-profissional')}}"> Problemas reportados </a>
                            </li>

                        </ul>
                    </li>
                @endif

                <li class="menu">
                        <a href="#politica" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                            <div class="">
                               <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <span>Política</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="politica" data-parent="#accordionExample" style="">
                            <li>
                                <a href="/termos-condicoes"> Termos e Condições </a>
                            </li>
                            <li>
                                <a href="/conduta-etica"> Código de Conduta </a>
                            </li>

                        </ul>
                    </li>


                


                @if($active == 'sair')
                    <li class="menu">
                        <a href="#" onclick="sair()" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <span> Terminar Sessão </span>
                            </div>
                        </a>
                    </li>
                @else
                    <li class="menu">
                        <a href="#" onclick="sair()" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span> Terminar Sessão </span>
                            </div>
                        </a>
                    </li>
                @endif
        </ul>

    </nav>

</div>
