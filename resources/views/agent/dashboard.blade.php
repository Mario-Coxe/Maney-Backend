@extends('layout')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/widgets/modules-widgets.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('custom.css')}}">

@section('content')
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
    <div class="widget widget-card-four">
        <div class="widget-content">
            <div class="w-content">
                <div class="w-info">
                    <p class="">Projectos Pendentes</p>
                    <h6 class="value">@{{ dis }}</h6>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
    <div class="widget widget-card-four">
        <div class="widget-content">
            <div class="w-content">
                <div class="w-info">
                    <p class="">Projectos Em Andamento</p>
                    <h6 class="value">@{{ pemandamento }}</h6>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection



<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('token');
        const user = JSON.parse(localStorage.getItem('user'));
        const userId = user.id;
        const apiUrl = `http://192.168.151.90:8080/api/v1/getAtmAgent/${userId}`;

        axios.get(apiUrl, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => {
                const atmAgents = response.data;
            })
            .catch(error => {
                console.error('Erro ao buscar os dados dos ATMs:', error);
            });
    });
</script>