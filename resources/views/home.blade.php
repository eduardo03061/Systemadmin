
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('mensaje'))
                        <div class="alert alert-danger">F{{ session('mensaje') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">Lista de Usuarios                     <a href="{{ route('registrar') }}" class="float-right btn btn-success">+Agregar</a>
                    </div>

                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">NIK</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($usuarios as $usuario)

                            <tr>
                                <th scope="row">{{$usuario->Nick}}</th>
                                <td>{{$usuario->Nombre}}</td>
                                <td>{{$usuario->Apellidos}}</td>
                                <td>{{$usuario->Rol}}</td>
                                <td>{{$usuario->Correo}}</td>
                                <td><button id="btnGroupDrop1" type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('img/engranaje.svg')}}" alt="" width="20px">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="{{route('users.edit',$usuario->Nick)}}">Editar usuario</a>

                                            <form action="{{route('users.destroy',$usuario->Nick)}}" method="POST" name=deleteform >
                                                @csrf
                                                <input class="dropdown-item" type="button" onclick="pregunta()"  value="Eliminar">
                                            </form>


                                            <form action="#">
                                                @csrf
                                                <input class="dropdown-item" type="submit" value="Editar estado deF cuenta">
                                            </form>



                                    </div>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
            function pregunta(){
                if (confirm('¿Estas seguro de eliminar este usuario?')){
                    document.deleteform.submit()
                }
            }
    </script>
@endsection
