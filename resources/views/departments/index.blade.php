@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Departamentos</h4>
                    @can('departments.create')
                    <a href="{{ route('departments.create') }}" class="btn btn-primary">
                        Crear
                    </a>
                    @endcan
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Nombre</th>
                                <th>Display Name</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                            <tr>
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->display_name }}</td>
                                <td width="10px">
                                    @can('departments.show')
                                    <a href="{{ route('departments.show',$department->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Ver</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('departments.edit')
                                    <a href="{{ route('departments.edit',$department->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('departments.destroy')
                                    {!! Form::open(['route'=>['departments.destroy',$department->id],'method'=>'DELETE']) !!}
                                        <button class="btn btn-sm btn-danger">Eliminar</button>
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $departments->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection