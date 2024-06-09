<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Bumbeiros Cliente </title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.svg')}}" />
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/js/loader.js')}}"></script>

    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />

    @yield('css')
    <style>
        .layout-px-spacing {
            min-height: calc(100vh - 166px) !important;
        }
    </style>

</head>

<body>
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>

    <div id="app">
        <div class="header-container fixed-top">
            @include('includes.menu-header')

        </div>
        <div class="sub-header-container">
            <header class="header navbar navbar-expand-sm">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><i data-feather="menu"></i></a>

                <ul class="navbar-nav flex-row">
                    <li>
                        <div class="page-header">
                            <div class="page-title">
                                <h3>Painel </h3>
                            </div>
                        </div>
                    </li>
                </ul>
            </header>
        </div>

        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            @include('includes.menu',['active'=>'projectos'])
            <div id="content" class="main-content">
                <div class="layout-px-spacing">
                    <div class="row layout-top-spacing" id="cancel-row">
                        @yield('content')
                        <div class="modal fade" id="criar" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Criar Projecto</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.stop.prevent="saveproject()">
                                            <div class="form-group mb-3">
                                                <label>Nome do Projecto</label>
                                                <input required v-model="newproject.titulo" type="text" class="form-control" placeholder="Titulo do Projecto">
                                            </div>
                                            <div class="form-group mb-3">
                                                <textarea required v-model="newproject.descricao" class="form-control" rows="3" placeholder="Descreva o seu projecto"></textarea>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Categoria do Projecto</label>
                                                <select required v-model="newproject.categoria" class="placeholder js-states form-control">
                                                    <option disabled selected>Escolha uma Categoria...</option>
                                                    <option v-for="cat in categorias" :key="cat.id" v-bind:value="cat.id">@{{ cat.name }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Tipos de Pagamentos</label>
                                                <select required v-model="newproject.pagamento" class="placeholder js-states form-control">
                                                    <option v-for="pagamento in tipo_de_pagamento" :key="pagamento.id" v-bind:value="pagamento.id">@{{ pagamento.name }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>Prazo</label>
                                                <input type="date" required min="<?= date('Y-m-d'); ?>" v-model="newproject.data" value="2021-09-19" class="form-control" placeholder="Prazo">
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3 btn-block">Criar Projecto</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="avaliar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="text-right cross"> <i class="fa fa-times mr-2"></i> </div>
                                    <div class="card-body text-center"> <img src=" https://i.imgur.com/d2dKtI7.png" height="100" width="100">
                                        <div class="comment-box text-center">
                                            <h4>Avalie a Plataforma</h4>
                                            <div class="comment-area"> <textarea v-model="comment" required class="form-control" placeholder="Conte como foi a sua experiência na Bumbeiros" rows="4"></textarea> </div>
                                            <div class="text-center mt-4"> <button @click="avaliar()" class="btn btn-success send px-5 btn-block">Avaliar <i class="fa fa-long-arrow-right ml-1"></i></button> </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal fade modal-notification" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" id="standardModalLabel">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <div class="icon-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                            </svg>
                                        </div>
                                        <p class="modal-text">

                                        <p><a class="proposta-link" href="#">Ver Proposta</a></p>
                                        </p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" data-dismiss="modal" class="btn btn-primary btn-block">Ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/dash_1.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('plugins/font-icons/feather/feather.min.js')}}"></script>
<script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugins/sweetalerts/custom-sweetalert.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('logout.js')}}"></script>
<script type="text/javascript">
    feather.replace();
    $(document).on("click", ".notification", function() {
        var notification = {
            "id": $(this).data('id'),
            "body": $(this).data('body'),
            "type": $(this).data('type'),
            "chat": $(this).data('chat')
        };
        $(".modal-text")[0].innerText = notification['body'];
        $(".proposta-link")[0].href = "http://135.181.43.100:3400/painel/propostas?chat=" + notification['chat'];
    });

    $(document).ready(function() {
        App.init();
    });
</script>

@yield('scripts')

</html>