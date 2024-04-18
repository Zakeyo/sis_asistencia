@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Actualización del rol</h1>
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
                        <h3 class="card-title text-center">Modifique los datos</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">

                        {!! Form::model($role, ['route' => ['rolesypermisos.update', $role->id], 'method' => 'put']) !!}

                            @include('rolesypermisos.partials.form')

                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="{{url('rolesypermisos')}}" class="btn btn-danger">Cancelar</a>
                                        {!! Form::submit('Actualizar Rol', ['class'=>'btn btn-success']) !!}
                                    </div>
                                </div>
                            </div>

                        {!! Form::close() !!}

                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')

       <script>
    $(document).ready(function() {
        $('#permisos').select2({

            placeholder: 'Seleccione Permiso',

        });

    })
</script>
@endpush