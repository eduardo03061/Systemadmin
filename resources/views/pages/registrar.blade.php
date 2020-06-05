@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Usuario</div>
                    @if (session('mensaje'))
                        @if (session('mensaje')=='El NICK no inicia con _ o con una letra' || session('mensaje')=='El rol no es admitido')
                            <div class="alert alert-danger">{{ session('mensaje') }}</div>
                        @else
                            <div class="alert alert-success">{{ session('mensaje') }}</div>
                        @endif
                    @endif
                    <div class="card-body">
                            @if (isset($usuario))
                            <form method="POST" action="{{ route('users.update') }}">
                            @else
                                <form method="POST" action="{{ route('guardar-user') }}">
                            @endif
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('NICK') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control @error('nick') is-invalid @enderror" name="nick" value="@if (isset($usuario)){{$usuario->Nick}} @endif{{ old('nik') }}" required autocomplete="name" autofocus>
                                    @error('nick')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nombre" value="@if (isset($usuario)){{$usuario->Nombre}} @endif{{ old('nombre') }}" required>

                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="apellidos" value="@if (isset($usuario)){{$usuario->Apellidos}} @endif{{ old('apellidos') }}" required autocomplete="email">


                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('rol') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="exampleFormControlSelect1" name="rol">
                                        @if (isset($usuario))<option>{{$usuario->Rol}} </option>@endif
                                        <option>Admin</option>
                                        <option>Operador</option>
                                        <option>Administrativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control " name="correo" required value="@if (isset($usuario)) {{$usuario->Correo}}  @endif">

                                    @error('correo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" value="@if (isset($usuario)) {{ $usuario->Password}} @endif">
                                    <input type="checkbox" onclick="myFunction()">Show Password
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                                    @if (isset($usuario))
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Actualizar') }}
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Registrar') }}
                                        </button>
                                    </div>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
        x.type = "text";
        } else {
        x.type = "password";
        }
        }
    </script>
@endsection
