@extends('layouts.admin_layout')

@section('title', 'Create Position')

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

                    </div><!-- /.col -->
                </div><!-- /.row -->
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <!-- general form elements -->
            <div class="col-md-5">
                <div class="card card-primary">
                    <!-- form start -->
                    <form action="{{ route('positions.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" value="submit" name="submitbutton" class="btn btn-primary">Submit
                            </button>
                            <a class="btn btn-default btn-close" href="{{ route('positions.index') }}">Cancel</a>
                        </div>

                    </form>


                </div>
            </div>

            <!-- /.card -->


        </section>

        <!-- /.content -->
    </div>
@endsection

