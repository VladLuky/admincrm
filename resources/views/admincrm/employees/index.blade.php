@extends('layouts.admin_layout')

@section('title', 'Employees')

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
                            <a href="{{ route('employees.create') }}" class="btn btn-block btn-primary" >
                                Add Employee
                            </a>
                        </ol>
                    </div><!-- /.col -->
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

        <section class="content filter">
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Filter</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('employees.index') }}" method="GET">
                        <div class="row">
                            <div class="col-4">
                                <h5>Name</h5>
                                <input type="text" class="form-control" name="names" placeholder="Name"
                                       @if(isset($_GET['names']))
                                       value="{{ $_GET['names'] }}"
                                    @endif>
                            </div>
                            <div class="col-4">
                                <h5>Position</h5>
                                <select class="form-control" name="pos_names" >
                                    @if(empty($positions))
                                        <option value="Empty">Empty</option>
                                    @else
                                        <option></option>
                                        @foreach($positions as $position)
                                            <option type="text" value="{{ $position['name'] }}"
                                            @if(isset($_GET['pos_names']))
                                                @if($_GET['pos_names'] == $position['name'])
                                                    selected
                                                @endif
                                            @endif>{{ $position['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-4">
                                <h4>Date of Employment</h4>
                                <div class="row">
                                    <div class="col-2">
                                        <p>Min:</p>
                                    </div>
                                    <div class="col">
                                        <input name="min_data" type="date" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <p>Max:</p>
                                    </div>
                                    <div class="col">
                                        <input name="max_data" type="date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-sm-2">

                        </div>
                        <div class="row">
                            <div class="col-4">
                                <h5>Phone</h5>
                                <input type="text" id="phone" name="phones" class="form-control" placeholder="Phone"
                                       @if(isset($_GET['phones']))
                                       value="{{ $_GET['phones'] }}"
                                    @endif>
                            </div>
                            <div class="col-4">
                                <h5>Email</h5>
                                <input type="text" name="emails" class="form-control" placeholder=".col-4"
                                       @if(isset($_GET['emails']))
                                       value="{{ $_GET['emails'] }}"
                                    @endif>
                            </div>
                            <div class="col-4">
                                <h4>Salary</h4>
                                <div class="row">
                                    <div class="col-2">
                                        <p>Min:</p>
                                    </div>
                                    <div class="col">
                                        <input name="min_salary" type="number" min="0">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <p>Max:</p>
                                    </div>
                                    <div class="col">
                                        <input name="max_salary" type="number" min="0">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="table">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th >
                            Photo
                        </th>
                        <th >
                            Name
                        </th>
                        <th>
                            Position
                        </th>
                        <th>
                            Date of Employment
                        </th>
                        <th >
                            Phone
                        </th>
                        <th >
                            Email
                        </th>
                        <th >
                            Salary
                        </th>
                        <th style="width: 20%; text-align: center;">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $emp)
                        <tr>
                            <td>
                                @if(strpos($emp['photo'], "http") !== false)
                                    <img src="{{$emp['photo']}}" style="width: 3em; border-radius: 50%">
                                @else
                                    <img src="/images/{{$emp['photo']}}" style="width: 3em; border-radius: 50%">
                                @endif
                            </td>
                            <td>
                                {{ $emp['name'] }}
                            </td>
                            <td>
                                {{ $emp['position'] }}
                            </td>
                            <td >

                            </td>
                            <td>
                                {{ $emp['phone'] }}
                            </td>
                            <td>
                                {{ $emp['email'] }}
                            </td>
                            <td>
                                {{ $emp['salary'] }}
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route( 'employees.edit', $emp['id']) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <button class="btn btn-danger btn-sm" data-emp_name="{{ $emp['name'] }}" data-catid="{{$emp->id}}" data-toggle="modal" data-target="#delete">
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
    @if(empty($emp))
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
                    <form action="{{ route('employees.destroy', 'test') }}" method="POST"
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"
            integrity="sha512-d4KkQohk+HswGs6A1d6Gak6Bb9rMWtxjOa0IiY49Q3TeFd5xAzjWXDCBW9RS7m86FQ4RzM2BdHmdJnnKRYknxw=="
            crossorigin="anonymous">

    </script>
@endsection
