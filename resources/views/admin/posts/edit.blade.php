@extends('layouts.master')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Publicaciones
                    <small class="text-muted text-md">Editar publicacion</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Edit</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@stop
@section('content')
    @include('partials.show_messages')
<form method="POST" action="{{ route('admin.posts.update', $post) }}">
    @csrf
    {{method_field('PUT')}}
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Titulo de la publicacion</label>
                        <input name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $post->title) }}"
                               placeholder="Inresa aqu&iacute; el t&iacute;tulo de la publicaci&oacute;n">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Extracto de la publicacion</label>
                        <textarea name="excerpt"
                                  class="form-control @error('excerpt') is-invalid @enderror"
                                  id="editor"
                                  placeholder="Inresa aqu&iacute; el extracto de la publicaci&oacute;n">{{old('excerpt',$post->excerpt)}}</textarea>
                        @error('excerpt')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Fecha de publicacion:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                            </div>
                            <input name="published_at"
                                   type="text"
                                   class="form-control float-right @error('published_at') is-invalid @enderror "
                                   id="datepicker"
                                   value="{{ old('published_at', $post->published_at ? $post->published_at->format('d/m/Y') : null )}}">
                            @error('published_at')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Categorias</label>
                        <select name="category"
                                class="form-control @error('category') is-invalid @enderror">
                            <option value="">Selecciona una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category',$post->category_id)===$category->id ? 'selected':''}}
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Etiquetas</label>
                        <select name="tags[]" class="select2 form-control @error('tags') is-invalid @enderror" multiple="multiple" data-placeholder="Selecciona una o mas etiquetas" style="width: 100%;">
                            @foreach ($tags as $tag)
                                <option {{collect(old('tags',$post->tags->pluck('id')))->contains($tag->id) ? 'selected':''}}
                                        value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Guardar Publicacion</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')

    <script>
        $(function () {
            $('#datepicker').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            $('#editor').summernote({
                height:'300px'
            });
            $('.select2').select2()
        });
    </script>

@endpush