@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Datos del usuario</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Datos del registro</h3>
                    </div>
                    <div class="card">        
                        <div class="card-body">
                            <form method="POST" action="{{ url('usuarios') }}">
                                @csrf
        
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Nombre y Apellido</label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name }}" disabled>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Correo electronico</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario->email }}" disabled>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Fecha de ingreso</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="text" class="form-control" value="{{$usuario->fecha_ingreso}}" disabled>
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{url('usuarios')}}" class="btn btn-danger">Volver</a>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>


@endsection

