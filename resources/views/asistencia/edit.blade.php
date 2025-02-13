@extends('layouts.admin')
@section('content')
    <section class="content container-fluid">
        <h1>Editar asistencia</h1>

        <div class="row">
            <div class="col-md-11">
                @includeif('partials.errors')
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <span class="card-title">Edición de asistencias</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('asistencias.update', $asistencia->id) }}" role="form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <h6 style="color: red">Los campos con (<b>*</b>) son obligatorios</h6>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('Miembros') }}
                                                <label for="miembro_id" style="color: red;">*</label>
                                                <select id="miembro_id" class="form-control @error('miembro_id') is-invalid @enderror" name="miembro_id" required>
                                                    <option value="" disabled selected>-- MIEMBROS LISTADOS --</option>
                                                    @foreach($miembros as $miembro)
                                                        <option value="{{ $miembro->id }}" 
                                                                data-cedula="{{ number_format($miembro->cedula, 0, '.', '.') }}" 
                                                                data-cargo="{{ $miembro->cargo->nombre_cargo }}"
                                                                @if($miembro->id == $asistencia->miembro_id) selected @endif>
                                                            {{ $miembro->nombre_apellido }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('miembro_id', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cedula">Cédula</label>
                                                <input type="text" id="cedula" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cargo">Personal</label>
                                                <input type="text" id="cargo" class="form-control" disabled>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fecha">Fecha <span style="color: red;">*</span></label>
                                                <div class="input-group date" id="datepicker">
                                                    <input type="text" name="fecha" value="{{ old('fecha', \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y')) }}" class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" placeholder="Fecha de asistencia">
    
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hora_entrada">Hora de Entrada <span style="color: red;">*</span></label>
                                                <input type="time" name="hora_entrada" value="{{ old('hora_entrada', $asistencia->hora_entrada) }}" class="form-control{{ $errors->has('hora_entrada') ? ' is-invalid' : '' }}">
                                                {!! $errors->first('hora_entrada', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hora_salida">Hora de Salida <span style="color: red;">*</span></label>
                                                <input type="time" name="hora_salida" value="{{ old('hora_salida', $asistencia->hora_salida) }}" class="form-control{{ $errors->has('hora_salida') ? ' is-invalid' : '' }}">
                                                {!! $errors->first('hora_salida', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer mt-4">
                                    <a href="{{ url('asistencias') }}" class="btn btn-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{-- SCRIPTS --}}
<div>
    {{-- MUESTRA CÉDULA Y CARGO AUTOMÁTICAMENTE --}}
    <script type="text/javascript">
        document.getElementById('miembro_id').addEventListener('change', function() {
            // Obtener la opción seleccionada
            var selectedMiembroOption = this.options[this.selectedIndex];
            
            // Obtener la cédula y el cargo del miembro seleccionado usando los atributos `data`
            var selectedMiembroCedula = selectedMiembroOption.getAttribute('data-cedula');
            var selectedMiembroCargo = selectedMiembroOption.getAttribute('data-cargo');
            
            // Actualizar los campos de cédula y cargo con los datos del miembro seleccionado
            document.getElementById('cedula').value = selectedMiembroCedula;
            document.getElementById('cargo').value = selectedMiembroCargo;
        });

        // Cuando se carga la página, si ya hay un miembro seleccionado, actualizar cédula y cargo automáticamente
        document.addEventListener("DOMContentLoaded", function() {
            var selectedMiembroOption = document.getElementById('miembro_id').options[document.getElementById('miembro_id').selectedIndex];
            var selectedMiembroCedula = selectedMiembroOption.getAttribute('data-cedula');
            var selectedMiembroCargo = selectedMiembroOption.getAttribute('data-cargo');
            document.getElementById('cedula').value = selectedMiembroCedula;
            document.getElementById('cargo').value = selectedMiembroCargo;
        });
    </script>
</div>
@endsection
