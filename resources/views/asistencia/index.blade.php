@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <h1>Listado de asistencias</h1>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary shadow">
                <div class="card-header">
                    <h3 class="card-title text-center">Asistencias registradas</h3>
                    <div class="card-tools">
                        @can('asistencias.create')
                        <a href="{{url('/asistencias/create')}}" class="btn btn-primary">
                            <i class="bi bi-person-plus" style="font-size: 112%;"> Agregar nueva asistencia</i>
                        </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead">
                                <tr>
                                    <th hidden>Nº</th>
                                    <th>ID</th>
                                    <th>Miembro</th>
                                    <th>Cedula</th>
                                    <th>Fecha</th>
                                    <th>H. Entrada</th>
                                    <th>H. Salida</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asistencias as $asistencia)
                                <tr>
                                    <td hidden>{{ ++$i }}</td>
                                    <td>
                                        <a href="{{ route('miembros.show', $asistencia->miembro->id) }}">
                                            {{ str_pad($asistencia->miembro->id, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </td>
                                    <td>{{ $asistencia->miembro->nombre_apellido }}</td>
                                    <td>{{ number_format($asistencia->miembro->cedula, 0, '.', '.') }}</td>
                                    <td>{{ $asistencia->fecha->format('d/m/Y') }}</td>
                                    <td>{{ $asistencia->hora_entrada }}</td>
                                    <td>{{ $asistencia->hora_salida }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group">
                                            <a href="{{route('asistencias.show', $asistencia->id)}}" type="button"
                                                class="btn btn-info"><i class="bi bi-eye"></i></a>
                                        </div>
                                        @can('asistencias.edit')
                                        <div class="btn-group" role="group">
                                            <a href="{{route('asistencias.edit', $asistencia->id)}}" type="button"
                                                class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                        </div>
                                        @endcan
                                        @can('asistencias.destroy')
                                        <div class="btn-group" role="group">
                                            <form action="{{route('asistencias.destroy', $asistencia->id)}}"
                                                method="POST" class="formulario-eliminar">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-danger eliminar-asistencia"
                                                    data-nombre="{{ $asistencia->miembro->nombre_apellido }}"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $asistencias->links() !!}
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<div>
    {{-- DATATABLES --}}
    <script>
        $(function () {
            $("#example1").DataTable({
                "pageLength": 10,
                "order": [[0, 'desc']],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Asistencias",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Asistencias",
                    "infoFiltered": "(Filtrado de _MAX_ total Asistencias)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Asistencias",
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
                "responsive": true, "lengthChange": true, "autoWidth": false
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    {{-- SWEETALERT AL CREAR ASISTENCIA --}}
    @if(session('mensaje'))
    <script>
        Swal.fire({
            title: "¡Bien!",
            text: "{{ session('mensaje') }}",
            icon: "success"
        });
    </script>
    @endif

    {{-- SWEETALERT AL ELIMINAR ASISTENCIA --}}
    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();
            var nombre = "<b>" + $(this).find('.eliminar-asistencia').data('nombre') + "</b>";
            Swal.fire({
                title: "¿Estás seguro?",
                html: "¿Deseas eliminar la asistencia de " + nombre + "?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminarlo"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>

    {{-- SWEETALERT RECARGA LA PÁGINA AL ELIMINAR ASISTENCIA --}}
    @if(session('eliminar') == 'eliminar')
    <script>
        Swal.fire({
            title: "¡Eliminado!",
            text: "Los datos han sido eliminados.",
            icon: "success"
        });
    </script>
    @endif
</div>

    {{-- SWEETALERT PARA ASISTENCIA AÑADIDA DESDE EL INDEX --}}
@if (session('success'))
    <script>
        Swal.fire({
            title: "¡Éxito!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "Aceptar"
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: "¡Error!",
            text: "{{ session('error') }}",
            icon: "error",
            confirmButtonText: "Aceptar"
        });
    </script>
@endif

@endsection
