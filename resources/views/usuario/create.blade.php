@extends('theme.base')
@section('content')

    <div class="container my-5 pt-2">
        <div class="row justify-content-center align-items-center p-5">
            <div class="col-lg-8 bg-light p-3">
                <h2>Registro</h2>
                <form action="{{ route('Usuario.store') }}" method="post">

                    @include('theme.alert')
                    @csrf
                    <div class="mb-3">
                        <label for="nombreUsusario" class="form-label">Nombre de ususario</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Ususario">
                        @error('username')
                            <div>
                                <small class="text-danger font-weight-bold">*{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contra" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="**********">
                        @error('password')
                            <div>
                                <small class="text-danger font-weight-bold">*{{ $message }}</small>
                            </div>
                        @enderror
                    </div>
                    {{-- Tipo de ususario SOLO ADMIN --}}
                    @if (session()->get('typeUser') == 'admin')
                        <div class="mb-3">
                            <label class="form-check-label" for="adminType">Administrador</label>
                            <input class="form-check-input" type="checkbox" value="admin" id="adminType" name="type">
                        </div>
                    @endif

                    <div class="pb-2 fixed-bottom bg-light">
                        <div class="row d-flex justify-content-center p-1">
                            <div class="col">
                                <div class="row d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary d-block w-50">Registrar</button>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center p-1">
                            <div class="col">
                                <div class="row d-flex justify-content-center">
                                    <a href="{{ route('Welcome.index') }}"
                                        class="btn btn-outline-success d-block w-50">Inicio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
