@extends('theme.base')

@section('content')
@section('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@1,600&display=swap" rel="stylesheet">

    <style>
        .titulo {
            font-family: 'Dancing Script', cursive;
        }

        .subTitulo {
            font-family: 'Source Code Pro', monospace;
        }

        /* 
                                                    @media (min-width:750px) {
                                                        .imgX {
                                                            min-width: 400px;

                                                        } */
        }

    </style>

@endsection
@include('theme.alert')
@php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
@endphp
@if (isset($_SESSION['estado']))
    <div class="alert alert-{{ $_SESSION['alert'] }} mt-5 pt-4" role="alert">
        {{ $_SESSION['estado'] }}
    </div>
@endif

<?php
if (isset($_SESSION['estado'])) {
    unset($_SESSION['estado']);
    unset($_SESSION['alert']);
}
?>
<div class="container d-flex justify-content-center  mt-5">
    <div class="card mb-1 mt-5 pt-2" style="max-width: 1000px;">
        <div class="row g-0 d-flex justify-content-center">
            <div class="col-lg-4 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/Logo.png') }}" class="img-fluid" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    {{-- Texto --}}
                    <div class="position-relative overflow-hidden p-1 text-center">
                        <div class="col-md-8 p-lg-5 mx-auto my-5">
                            <div class="mb-1">
                                <p class="titulo fs-1 text m-0 p-0 b-0">Ele's </p>
                                <p class="text-muted subTitulo">Sistema contable</p>
                            </div>
                            <p class="lead fw-normal">
                                Ropa y accesorios para damas y caballeros <br>
                                El Salvador 🇸🇻<br>
                                Envíos a todo el país 🚚<br>
                                Entregas coordinadas en zonas céntricas de San Miguel
                            </p>
                            @if (session()->missing('typeUser'))
                                <a class="btn btn-outline-secondary" href="{{ route('login.loguear') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                        <path fill-rule="evenodd"
                                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                    </svg>
                                    Iniciar sesión
                                </a>
                            @endif

                        </div>
                        <div class="product-device shadow-sm d-none d-md-block"></div>
                        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
                    </div>
                    {{-- /texto --}}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {
        setTimeout(() => {
            $(".alert").remove();
        }, 5000);

        $("#debe").val(currency(sDebe))
        $("#haber").val(currency(sHaber))
    });
</script>

@endsection
