@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Actualización del usuario</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Modifique los campos</h3>
                    </div>
                    <div class="card">        
                        <div class="card-body">
                            <form method="POST" action="{{ url('usuarios', $usuario->id) }}">
                                @csrf
                                {{method_field('PATCH')}}
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Nombre y Apellido</label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usuario->name }}" required >
        
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
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario->email }}" required >
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Nueva contraseña</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  >
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    {!! Form::model($usuario, ['route' => ['usuarios.update', $usuario], 'method' => 'put']) !!}
                                    <div class="col-md-4 col-form-label text-md-end">
                                        {{ Form::label('roles', 'Roles y permisos') }}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::select('roles', ['' => '-- SIN ROL --'] + $roles->pluck('name', 'id')->toArray(), null, ['class' => 'form-control' . ($errors->has('roles') ? ' is-invalid' : '')]) }}
                                            {!! $errors->first('roles', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <a href="{{url('usuarios')}}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-success">
                                            Actualizar
                                        </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </form>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>

<script>
    $(function () {
    $("#example1").DataTable({
        "pageLength": 10,
        "order": [[0, 'desc']],
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
            "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
            "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Usuarios",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscador:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "responsive": true, "lengthChange": true, "autoWidth": false,
        buttons: [{
            extend: 'collection',
            text: 'Reportes',
            orientation: 'landscape',
            buttons: [
                { text: 'Imprimir como PDF', extend: 'pdf', exportOptions: { columns: ':not(:last-child, :nth-last-child(2))' } },
                { text: 'Imprimir como EXCEL',extend: 'excel', exportOptions: { columns: ':not(:last-child, :nth-last-child(2))' } },
            ]
        },
        ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@if($message = Session::get('mensaje'))
    <script>
            Swal.fire({
                title: "¡Felicidades!",
                text: "{{$message}}",
                icon: "success"
            });
    </script>
@endif

@endsection

