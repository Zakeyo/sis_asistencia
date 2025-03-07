@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Creación de un nuevo personal</h1>
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{$error}}</li>
            </div>
        @endforeach
        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Datos a agregar</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <form action="{{url('/cargos')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 style="color: red">Los campos con (<b>*</b>) son obligatorios</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre</label><b style="color:red"> *</b>
                                                <input type="text" name="nombre_cargo" value="{{old('nombre_cargo')}}" class="form-control" placeholder="Ingrese el nombre del Personal" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Descripción</label>
                                                <textarea class="form-control" name="descripcion_cargo" value="{{old('descripcion_cargo')}}" placeholder="Agregue una descripción del Personal"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <hr>
    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{url('cargos')}}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection