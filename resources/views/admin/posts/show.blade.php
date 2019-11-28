@extends('layouts.master')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Publicaciones
                    <small class="text-muted text-md">Mostrar publicacion</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        {{ $post->present()->postTitle() }}
                    </div>
    
                    <div class="card-body">
    
                        <p class="card-text">{{ $post->excerpt }}</p>
    
    
                        <ul class="list-unstyled">
                         @foreach ($post->documents as $document)
                            <li><i class="far fa-file-pdf"></i> <a href="{{ $document->path }}">{{ $document->title }}</a></li>
                        @endforeach
                        </ul>
    
                        {{-- <small class='text-muted text-right'>{{ $post->present()->categories()}}</small>
                        <div class="d-flex justify-content-between">
                            <small class='text-muted'>{{ $post->present()->dateForHumans()}}</small>
                            <div class="btn-group">
                                @can('admin.posts.show')
                                <a href="{{ route('admin.posts.show',$post->id) }}"
                                    class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i></a>
                                @endcan
    
                                @can('admin.posts.edit')
                                <a href="{{ route('admin.posts.edit',$post->id) }}"
                                    class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>
                                @endcan
    
                                @can('admin.posts.destroy')
                                {!! Form::open(['route'=>['admin.posts.destroy',$post->id],'method'=>'DELETE']) !!}
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                {!! Form::close() !!}
                                @endcan
                            </div>
                        </div> --}}
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection