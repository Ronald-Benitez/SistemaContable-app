@extends('theme.base')
@section('content')

    <div class="container">
        <div class="row mt-5 justify-content-center align-items-center">
            <div class="col-lg-6 bg-light p-5">
                <h2>Editar datos</h2>
                <form action="{{ route('Usuario.update', $usuario->id) }}" method="post">

                    @csrf
                    @include('theme.alert')

                    @method('put')
                    <div class="mb-3">
                        <label for="nombreUsusario" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ $usuario->username }}">

                        @error('username')
                            <div>
                                <small class="text-danger font-weight-bold">*{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contra" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password">

                        <input type="checkbox" class="form-check-input" name="cambiar" value="1">
                        <label class="form-check-label">Cambiar contraseña</label>

                        @error('password')
                            <div>
                                <small class="text-danger font-weight-bold">*{{ $message }}</small>
                            </div>
                        @enderror
                    </div>
                    @if (session()->get('typeUser') == 'admin')
                        <div class="mb-3">
                            <select class="form-select" name="type" id="type">
                                <option selected value="{{ $usuario->type }}">Tipo de usuario</option>
                                <option value="user">Usuario Normal</option>
                                <option value="admin">Administrador</option>
                            </select>
                            @error('type')
                                <div>
                                    <small class="text-danger font-weight-bold">*{{ $message }}</small>
                                </div>
                            @enderror
                    @endif

                    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                </form>
            </div>

        </div>

    </div>
@endsection

