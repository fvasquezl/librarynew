@extends('layouts.master')


@section('content-header')
@include('layouts.partials.contentHeaderHome',$info =[
'title' =>'Publicaciones',
'subtitle' => 'Usuario',
'breadCrumbs' =>[]
])
@stop

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4 shadow-sm card-outline card-primary">
                <div class="card-header d-flex bd-highlight">
                    <div class=" bd-highlight">
                        <select class="form-control" id="category-filter">
                            <option value="">Todas las categorias</option>
                            @foreach ($categories as $category)
                            <option>{{$category}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="ml-auto  bd-highlight">
                        @can('create',$posts->first())
                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus"></i>
                            Crear Publicacion
                        </button>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover nowrap" id="postsTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Titulo</th>
                                <th>Extracto</th>
                                <th>Asignado_a</th>
                                <th>F_Publicacion</th>
                                <th>Categoria</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{!!$post->present()->excerpt()!!}</td>
                                <td>{{$post->present()->departments()}}</td>
                                <td>{{$post->present()->publishedAt()}}</td>
                                <td>{{$post->present()->categories()}}</td>
                                <td>
                                    <a href="{{ route('posts.show',$post) }}" class="btn btn-sm btn-default"
                                        target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('update', $post)
                                    <a href="{{ route('admin.posts.edit',$post) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan

                                    @can('delete',$post)
                                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                        style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estas seguro de eliminar esta publicacion?')">
                                            <i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script>
    $(document).ready( function () {
        var table = $('#postsTable').DataTable({
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All']
            ],
            processing: true,
            stateSave: true,
            scrollY: "53vh",
            scrollX: true,

            dom: '"<\'row\'<\'col-md-6\'B><\'col-md-6\'f>>" +\n' +
                    '"<\'row\'<\'col-sm-12\'tr>>" +\n' +
                    '"<\'row\'<\'col-sm-12 col-md-5\'i ><\'col-sm-12 col-md-7\'p>>"',

                    buttons: {
                    dom: {
                        container: {
                            tag: 'div',
                            className: 'flexcontent'
                        },
                        buttonLiner: {
                            tag: null
                        }
                    },

                    buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        title: 'Products to Excel',
                        titleAttr: 'Excel',
                        className: 'btn btn-success',
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary buttons-html5 buttons-excel')
                        },
                        columns: [1,2, 3, 4, 5, 6]
                    },
                        {
                            extend: 'pageLength',
                            titleAttr: 'Show Records',
                            className: 'btn selectTable btn-primary',
                        }
                    ],
                },
        });

        $("#category-filter").on('change', function(){
            table.search(this.value).draw();
        });

    });
</script>
@endpush
