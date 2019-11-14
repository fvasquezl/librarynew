@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('partials.show_messages')
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Roles</h4>
                    @can('roles.create')
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        <i class="fas fa-address-card"></i> Crear Rol
                    </a>
                    @endcan
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Role</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td width="10px">
                                    @can('roles.show')
                                    <a href="{{ route('roles.show',$role->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Ver</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('roles.edit')
                                    <a href="{{ route('roles.edit',$role->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('roles.destroy')
                                    {!! Form::open(['route'=>['roles.destroy',$role->id],'method'=>'DELETE']) !!}
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $roles->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection