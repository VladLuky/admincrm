@extends('layouts.admin_layout')

@section('title', 'Positions')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('positions.create') }}" class="btn btn-block btn-primary" >
                                Add Position
                            </a>
                        </ol>
                    </div>
                </div><!-- /.row -->
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> {{ session('error') }}</h5>
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div>
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th >
                            Name
                        </th>
                        <th >
                            Last Update
                        </th>
                        <th style="width: 20%; text-align: center;">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($position as $pos)
                        <tr>
                            <td>
                                {{ $pos->name }}
                            </td>
                            <td>
                                {{ $pos['updated_at']->format('d.m.Y') }}
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route( 'positions.edit', $pos->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <button class="btn btn-danger btn-sm" data-emp_name="{{ $pos['name'] }}" data-catid="{{$pos->id}}" data-toggle="modal" data-target="#delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <!-- /.card-body -->
            </div>
        </section>
    </div>
    @if(empty($pos))
    @else
        <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm Action</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('positions.destroy', 'test') }}" method="POST"
                          style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="text-center" id="infotext">

                            </div>
                            <input type="hidden" name="emp_id" id="cat_id" value="">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                <i class="fas fa-trash">
                                </i>
                                delete
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('link_script')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/>
@endsection

@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            $('table.projects').DataTable()({
                "columnDefs": [
                    { "orderable": false, "targets": 0 }
                ],
                "order": [],
            });

        } );
    </script>
    <script>
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var cat_id = button.data('catid')
            var divinfo = document.getElementById('infotext')
            var emp_name = button.data('emp_name')
            var text = '<p>Delete \"' + emp_name + '\"</p>'
            divinfo.innerHTML = text
            var modal = $(this)
            modal.find('.modal-body #cat_id').val(cat_id);
        })
    </script>
@endsection
