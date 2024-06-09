@extends('layout')
@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/widgets/modules-widgets.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('custom.css')}}">
@endsection

@section('content')
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
   
</div>



@endsection

@section('scripts')
<script src="{{URL::asset('_/axios.js')}}"></script>
<script type="module" src="{{URL::asset('scripts/projects.js')}}"></script>
@endsection